<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Institution;
use App\Models\InstitutionCategory;
use App\Models\InstitutionClass;
use App\Models\InstitutionGroup;
use App\Models\Upazila;
use Illuminate\Http\Request;

class InstitutionVisitingReportController extends Controller
{
    /**
     * Display a listing of the institution visiting reports.
     */
    public function index(Request $request)
    {
        return view('dashboard.layouts.institution_visiting_report.index');
    }

    /**
     * Ajax Dtatable Display a listing of the institution visiting reports .
     */
    public function institutionList(Request $request)
    {
        $draw = $request->draw ?? 0;
        $start = $request->start ?? 0;
        $length = $request->length ?? 0;

        $query = Institution::with(['divisionData', 'district', 'upazila']);
        // Filtering logic
        if ($request->date_range) {
            $dates = explode(' - ', $request->date_range);
            if (count($dates) == 2) {
                $query->whereBetween('date', [$dates[0], $dates[1]]);
            }
        }

        if ($request->employee_id) {
            $query->where('employee_id', 'like', '%' . $request->employee_id . '%');
        }

        $totalRecords = $query->count();
        $institutions = $query->orderBy('created_at', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        // Prepare data for DataTables
        $data = [];
        foreach ($institutions as $key => $institution) {
            // Concatenate the required fields
            $DetailsAddress = implode('<br>', array_filter([
                'Address: ' . ($institution->detail_address ?? 'N/A'),
                'Division: ' . ($institution->divisionData->division_name ?? 'N/A'),
                'District: ' . ($institution->district->district_name ?? 'N/A'),
                'Upazila: ' . ($institution->upazila->upazila_name ?? 'N/A'),
                'Union: ' . ($institution->union_name ?? 'N/A'),
                'Area Name: ' . ($institution->area_name ?? 'N/A'),
            ]));

            $Summary = implode('<br>', array_filter([
                'Teachers Quantity: ' . ($institution->teachers_quantity ?? 'N/A'),
                'Student Quantity: ' . ($institution->student_quantity ?? 'N/A'),
            ]));

            $Comments = implode('<br>', array_filter([
                'Teachers Comments: ' . ($institution->teachers_comment ?? 'N/A'),
                'Senior Sales Executive Comments: ' . ($institution->senior_sales_executive_comments ?? 'N/A'),
            ]));

            // Action buttons
            $actionButtons = '
            <a class="me-2" href="' . route('institution.visiting.edit', encrypt($institution->id)) . '">
            <img src="' . asset('resources/assets/img/icons/edit.svg') . '" alt="img"></a>
            <a class="me-2 delete-btn" href="' . route("institution.visiting.destroy", encrypt($institution->id)) . '">
                <img src="' . asset('resources/assets/img/icons/delete.svg') . '" alt="img">
            </a>
        ';

            $data[] = [
                $key + 1,
                $institution->employee_id ?? 'Unknown',
                $institution->date ? date('d-m-Y', strtotime($institution->date)) : '',
                $institution->institution_name ?? 'N/A',
                $institution->teachers_name ?? 'N/A',
                $institution->designation ?? 'N/A',

                $institution->contact_number ?? 'N/A',
                $DetailsAddress,
                $Summary,
                $Comments,
                $actionButtons,
            ];
        }

        return response()->json([
            'draw' => intval($draw),
            'iTotalRecords' => $totalRecords,
            'iTotalDisplayRecords' => $totalRecords,
            'aaData' => $data,
        ]);
    }

    /**
     * division district,upazilla fatch.
     */
    public function getDistricts($divisionId)
    {
        $districts = District::where('district_division_id', $divisionId)->get();
        return response()->json($districts);
    }

    public function getUpazilas($districtId)
    {
        $upazilas = Upazila::where('upazila_district_id', $districtId)->get();
        return response()->json($upazilas);
    }

    /**
     * Show the form for editing the specified institution visiting report.
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $institution = Institution::with(['categories', 'classes', 'groups', 'divisionData', 'district', 'upazila'])->findOrFail($id);
        $divisions = Division::all();
        $districts = District::where('district_division_id', $institution->division)->get();
        $upazilas = Upazila::where('upazila_district_id', $institution->zilla)->get();

        return view('dashboard.layouts.institution_visiting_report.edit', compact('institution', 'divisions', 'districts', 'upazilas'));
    }

    /**
     * Update the specified institution visiting report.
     */
    public function update(Request $request, $id)
    {
        $id = decrypt($id);
        $request->validate([
            'institution_name' => 'required|string|max:255',
            'date' => 'required|date',
            'division' => 'required',
            'zilla' => 'required',
            'upazilla' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'string',
            'classes' => 'required|array',
            'classes.*' => 'string',
            'groups' => 'required|array',
            'groups.*' => 'string',
        ]);

        $institution = Institution::findOrFail($id);
        $institution->update($request->except(['categories', 'classes', 'groups']));

        InstitutionCategory::where('institution_id', $id)->delete();
        foreach ($request->categories as $category) {
            InstitutionCategory::create([
                'institution_id' => $id,
                'category' => $category,
            ]);
        }

        InstitutionClass::where('institution_id', $id)->delete();
        foreach ($request->classes as $class) {
            InstitutionClass::create([
                'institution_id' => $id,
                'class' => $class,
            ]);
        }

        InstitutionGroup::where('institution_id', $id)->delete();
        foreach ($request->groups as $group) {
            InstitutionGroup::create([
                'institution_id' => $id,
                'group_name' => $group,
            ]);
        }

        return redirect()->route('institution.visiting.index')->with('success', 'Institution visiting report updated successfully.');
    }

    /**
     * Remove the specified institution visiting report.
     */
    public function destroy($id)
    {
        $id = decrypt($id);
        $institution = Institution::findOrFail($id);
        $institution->categories()->delete();
        $institution->classes()->delete();
        $institution->groups()->delete();
        $institution->delete();

        return redirect()->route('institution.visiting.index')->with('success', 'Institution visiting report deleted successfully.');
    }
}

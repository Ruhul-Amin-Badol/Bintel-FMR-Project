<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\BatchCategory;
use App\Models\BatchCourse;
use App\Models\District;
use App\Models\Division;
use App\Models\Upazila;
use Illuminate\Http\Request;

class BatchVisitingReportController extends Controller
{
    /**
     * Display a listing of the batch visiting reports.
     */
    public function index(Request $request)
    {
        return view('dashboard.layouts.batch_visiting_report.batch_visiting_report_list');
    }

    //ajax datatable function
    public function batchList(Request $request)
    {
        $draw = $request->draw ?? 0;
        $start = $request->start ?? 0;
        $length = $request->length ?? 0;

        $query = Batch::with(['divisionData', 'district', 'upazila']);
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
        $batches = $query->orderBy('created_at', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        // Prepare data for DataTables
        $data = [];
        foreach ($batches as $key => $batch) {
            // Concatenate the required fields
            $DetailsAddress = implode('<br>', array_filter([
                'Address: ' . ($batch->detail_address ?? 'N/A'),
                'Division: ' . ($batch->divisionData->division_name ?? 'N/A'),
                'District: ' . ($batch->district->district_name ?? 'N/A'),
                'Upazila: ' . ($batch->upazila->upazila_name ?? 'N/A'),
                'Union: ' . ($batch->union_name ?? 'N/A'),
                'Area Name: ' . ($batch->area_name ?? 'N/A'),
            ]));
            $BatchSummary = implode('<br>', array_filter([
                'School Name: ' . ($batch->school_name ?? 'N/A'),
                'Teachers: ' . ($batch->teachers_quantity ?? 'N/A'),
                'Students: ' . ($batch->student_quantity ?? 'N/A'),
            ]));
            $AllComment = implode('<br>', array_filter([
                'Teachers Comments: ' . ($batch->teachers_comment ?? 'N/A'),
                'Senior Sales Executive Comments: ' . ($batch->senior_sales_executive_comments ?? 'N/A'),
            ]));

            // Add action buttons
            $actionButtons = '
            <a class="me-2" href="' . route('batch.visiting.edit', encrypt($batch->id)) . '">
            <img src="' . asset('resources/assets/img/icons/edit.svg') . '" alt="img"></a>

            <a class="me-2 delete-btn" href="' . route("batch.visiting.destroy", encrypt($batch->id)) . '">
                <img src="' . asset('resources/assets/img/icons/delete.svg') . '" alt="img">
            </a>
        ';

            $data[] = [
                $key + 1,
                $batch->employee_id ?? 'Unknown',
                $batch->date ? date('d-m-Y', strtotime($batch->date)) : '',
                $batch->batch_name ?? 'N/A',
                $batch->owner_name ?? 'N/A',
                $batch->contact_number ?? 'N/A',
                $DetailsAddress,
                $BatchSummary,
                $AllComment,
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

    public function edit($id)
    {
        $id = decrypt($id);
        $batch = Batch::with(['categories', 'courses', 'divisionData', 'district', 'upazila'])->findOrFail($id);
        $divisions = Division::all();
        $districts = District::where('district_division_id', $batch->division)->get();
        $upazilas = Upazila::where('upazila_district_id', $batch->zilla)->get();

        return view('dashboard.layouts.batch_visiting_report.batch_visiting_report_edit', compact('batch', 'divisions', 'districts', 'upazilas'));
    }

    /**
     * Update the specified batch visiting report.
     */
    public function update(Request $request, $id)
    {
        $id = decrypt($id);
        $request->validate([
            'batch_name' => 'required|string|max:255',
            'date' => 'required|date',
            'division' => 'required',
            'zilla' => 'required',
            'upazilla' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'string',
            'courses' => 'required|array',
            'courses.*' => 'string',
        ]);

        $batch = Batch::findOrFail($id);
        $batch->update($request->except(['categories', 'courses']));

        BatchCategory::where('batch_id', $id)->delete();
        foreach ($request->categories as $category) {
            BatchCategory::create([
                'batch_id' => $id,
                'category' => $category,
            ]);
        }

        BatchCourse::where('batch_id', $id)->delete();
        foreach ($request->courses as $course) {
            BatchCourse::create([
                'batch_id' => $id,
                'course' => $course,
            ]);
        }

        return redirect()->route('batch.visiting.index')->with('success', 'Batch visiting report updated successfully.');
    }

    /**
     * Remove the specified batch visiting report.
     */
    public function destroy($id)
    {
        $id = decrypt($id);
        $batch = Batch::findOrFail($id);
        $batch->categories()->delete();
        $batch->courses()->delete();
        $batch->delete();

        return redirect()->route('batch.visiting.index')->with('success', 'Batch visiting report deleted successfully.');
    }
}

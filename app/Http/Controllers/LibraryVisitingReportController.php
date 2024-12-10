<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Library;
use App\Models\LibraryCategory;
use App\Models\LibraryType;
use App\Models\Officer;
use App\Models\Upazila;
use Illuminate\Http\Request;

class LibraryVisitingReportController extends Controller
{

    //index function for logged-in officer wise library  show

    public function index()
    {
        $divisions = Division::all();
        $officers = Officer::all();

        return view('dashboard.layouts.library_visiting_report.library_visiting_report_list', compact('divisions', 'officers'));
    }

    public function libraryList(Request $request)
    {
        $draw = $request->draw ?? 0;
        $start = $request->start ?? 0;
        $length = $request->length ?? 10;

        $query = Library::with(['divisionData', 'district', 'upazila', 'officer']);

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

        if ($request->division_id) {
            $query->where('division', $request->division_id);
        }

        if ($request->district_id) {
            $query->where('zilla', $request->district_id);
        }

        if ($request->upazila_id) {
            $query->where('upazilla', $request->upazila_id);
        }

        $totalRecords = $query->count();
        $libraries = $query->orderBy('created_at', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        // Prepare data for DataTables
        $data = [];
        foreach ($libraries as $key => $library) {
            $DetailsAddress = implode('<br>', array_filter([
                'Address: ' . ($library->detail_address ?? 'N/A'),
                'Division: ' . ($library->divisionData->division_name ?? 'N/A'),
                'District: ' . ($library->district->district_name ?? 'N/A'),
                'Upazila: ' . ($library->upazila->upazila_name ?? 'N/A'),
                'Union: ' . ($library->union_name ?? 'N/A'),
                'Area Name: ' . ($library->area_name ?? 'N/A'),
            ]));
            $AllComment = implode('<br>', array_filter([
                'Librarian Comments: ' . ($library->librarian_comments ?? 'N/A'),
                'Senior Sales Executive Comments: ' . ($library->senior_sales_executive_comments ?? 'N/A'),
            ]));

            $actionButtons = '
            <a class="me-3" href="' . route('library.visiting-list.edit', encrypt($library->id)) . '">
                <img src="' . asset('resources/assets/img/icons/edit.svg') . '" alt="Edit">
            </a>
            <a class="me-3 delete-btn" href="' . route('library.visiting-list.destroy', encrypt($library->id)) . '">
                <img src="' . asset('resources/assets/img/icons/delete.svg') . '" alt="Delete">
            </a>
        ';

            $data[] = [
                $key + 1,
                $library->employee_id ?? 'Unknown',
                $library->date ? date('d-m-Y', strtotime($library->date)) : '',
                $library->library_Name ?? 'N/A',
                $library->owner_name ?? 'N/A',
                $library->contact_number ?? 'N/A',
                $DetailsAddress,
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
     * Show specific library details.
     */
    public function show($id)
    {
        $library = Library::with(['categories', 'types', 'divisionData', 'district', 'upazila'])->findOrFail($id);
        return view('library.show', compact('library'));
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
     * Edit specific library details.
     */

    public function edit($encryptedId)
    {
        // Decrypt the ID
        $id = decrypt($encryptedId);
        // Fetch library details
        $library = Library::with(['divisionData', 'district', 'upazila'])->findOrFail($id);

        // Fetch all divisions
        $divisions = Division::all();

        // Fetch districts and upazilas for the selected division and district
        $districts = District::where('district_division_id', $library->division)->get();
        $upazilas = Upazila::where('upazila_district_id', $library->zilla)->get();

        return view('dashboard.layouts.library_visiting_report.library_visiting_report_edit', compact('library', 'divisions', 'districts', 'upazilas'));
    }

    /**
     * Update specific library details.
     */

    // public function update(Request $request, $id)
    // {$id = decrypt($id);
    //     $library = Library::findOrFail($id);
    //     $library->update($request->all());

    //     return redirect()->route('library.visiting-list')->with('success', 'Library details updated successfully!');}

    public function update(Request $request, $id)
    {
        $id = decrypt($id);

        $library = Library::findOrFail($id);

        // Validate the input
        $request->validate([
            'categories' => 'required|array',
            'categories.*' => 'string',
            'types' => 'required|array',
            'types.*' => 'string',
        ]);

        // Update Library information (if there are other fields to update)
        $library->update($request->except(['categories', 'types']));

        // Sync Categories
        LibraryCategory::where('library_id', $id)->delete();
        foreach ($request->categories as $category) {
            LibraryCategory::create([
                'library_id' => $id,
                'category' => $category,
            ]);
        }

        // Sync Types
        LibraryType::where('library_id', $id)->delete();
        foreach ($request->types as $type) {
            LibraryType::create([
                'library_id' => $id,
                'library_type' => $type,
            ]);
        }

        return redirect()->route('library.show-list', $id)->with('success', 'Library updated successfully.');
    }

    /**
     * Delete specific library details.
     */
    public function destroy($id)
    {
        $id = decrypt($id);
        $library = Library::findOrFail($id);

        // Delete associated data
        $library->categories()->delete();
        $library->types()->delete();

        // Delete the library
        $library->delete();

        return redirect()->route('library.show-list')->with('success', 'Library Visiting Report deleted successfully.');
    }

}

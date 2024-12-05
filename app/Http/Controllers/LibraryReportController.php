<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LibraryReport;
use App\Models\Officer;
use App\Models\Upazila;

class LibraryReportController extends Controller
{
    public function LibraryReport()
    {

        $divisions = Division::orderBy('division_name', 'ASC')->get();

        $officers=Officer::all();

        return view("dashboard.layouts.library_report.add_library_report", compact('divisions','officers'));
    }




    public function getDistricts(Request $request)
    {
        $divisionId = $request->input('division_id');
        $districts = District::where('district_division_id', $divisionId)->get(['district_id', 'district_name']);

        return response()->json($districts);
    }


    public function getUpazilas(Request $request)
    {
        $districtId = $request->input('district_id');

        // Fetch upazilas based on the selected district ID
        $upazilas = Upazila::where('upazila_district_id', $districtId)->get(['upazila_id', 'upazila_name']);

        return response()->json($upazilas);
    }



    public function Library_visit_new_Action(Request $request)
    {

        $validated = $request->validate([
            'library_type' => 'nullable',
            'employee_id' => 'required',
            'library_name' => 'required',
            'owner_name' => 'required',
            'contact_number' => 'required|max:11|',
            'date' => 'required',
            'area' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
            'available_books' => 'required',
            'books_collected_from' => 'nullable',
            'sales_executive_comments' => 'nullable',
            'what_category_comments' => 'nullable',
            'agent_library_comments' => 'nullable',
            'any_problem_comments' => 'nullable',
            'new_books_on_time_comments' => 'nullable',
            'mr_contact_comments' => 'nullable',
            'improve_our_service_comments' => 'nullable',

        ]);


        $credentials = [
            'library_type' => $validated['library_type'],
            'employee_id' => $validated['employee_id'],
            'library_name' => $validated['library_name'],
            'owner_name' => $validated['owner_name'],
            'contact_number' => $validated['contact_number'],
            'date' => date("Y-m-d", strtotime($validated['date'])),
            'area' => $validated['area'],
            'division_id' => $validated['division_id'],
            'district_id' => $validated['district_id'],
            'upazila_id' => $validated['upazila_id'],
            'available_books' => $validated['available_books'] = implode(',', $validated['available_books']),
            'books_collected_from' => $validated['books_collected_from'] = implode(',', $validated['books_collected_from']),
            'sales_executive_comments' => $validated['sales_executive_comments'],
            'what_category_comments' => $validated['what_category_comments'],
            'agent_library_comments' => $validated['agent_library_comments'],
            'any_problem_comments' => $validated['any_problem_comments'],
            'new_books_on_time_comments' => $validated['new_books_on_time_comments'],
            'mr_contact_comments' => $validated['mr_contact_comments'],
            'improve_our_service_comments' => $validated['improve_our_service_comments'],

        ];





        LibraryReport::create($credentials);
        return back()->with('message', 'Library Report added Successfully!');
    }



    // public function library_list()
    // {


    //     // Fetch all library reports
    //     $libraryReports = LibraryReport::all();

    //     return view("dashboard.layouts.library_report.library_report_list", compact('libraryReports'));
    // }

    public function library_list(Request $request)
{
    $range = $request->range;
    if ($range) {
        $dateRange = explode(" - ", $range);
        $start = date("Y-m-d", strtotime($dateRange[0]));
        $end = date("Y-m-d", strtotime($dateRange[1]));
    } else {
        // Default to the current month if range is not provided
        $start = date("Y-m-01");
        $end = date("Y-m-t");
    }

    // Fetch library reports within the specified date range
    $libraryReports = LibraryReport::whereBetween('date', [$start, $end])->get();

    return view("dashboard.layouts.library_report.library_report_list", compact('libraryReports'));
}






    public function delete_library_visit(Request $request){

        $id=decrypt($request->id);
        LibraryReport::whereId($id)->delete();
        return back()->with('message', 'library visit Deleted Successfully!');

     }


     public function edit_library_visit(Request $request){
        $divisions = Division::orderBy('division_name', 'ASC')->get();
        $id=decrypt($request->id);
        $report=LibraryReport::whereId($id)->first();
        $officers=Officer::all();
        return view("dashboard.layouts.library_report.library_visit_edit")->with(compact('report','divisions','officers'));

    }


    public function edit_library_visit_Action(Request $request){


        $id=decrypt($request->id);


        $validated = $request->validate([
            'library_type' => 'nullable',
            'employee_id' => 'required',
            'library_name' => 'required',
            'owner_name' => 'required',
            'contact_number' => 'required|max:11|',
            'date' => 'required',
            'area' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
            'available_books' => 'required',
            'books_collected_from' => 'nullable',
            'sales_executive_comments' => 'nullable',
            'what_category_comments' => 'nullable',
            'agent_library_comments' => 'nullable',
            'any_problem_comments' => 'nullable',
            'new_books_on_time_comments' => 'nullable',
            'mr_contact_comments' => 'nullable',
            'improve_our_service_comments' => 'nullable',

        ]);


        $credentials = [
            'library_type' => $validated['library_type'],
            'employee_id' => $validated['employee_id'],
            'library_name' => $validated['library_name'],
            'owner_name' => $validated['owner_name'],
            'contact_number' => $validated['contact_number'],
            'date' => date("Y-m-d", strtotime($validated['date'])),
            'area' => $validated['area'],
            'division_id' => $validated['division_id'],
            'district_id' => $validated['district_id'],
            'upazila_id' => $validated['upazila_id'],
            'available_books' => $validated['available_books'] = implode(',', $validated['available_books']),
            'books_collected_from' => $validated['books_collected_from'] = implode(',', $validated['books_collected_from']),
            'sales_executive_comments' => $validated['sales_executive_comments'],
            'what_category_comments' => $validated['what_category_comments'],
            'agent_library_comments' => $validated['agent_library_comments'],
            'any_problem_comments' => $validated['any_problem_comments'],
            'new_books_on_time_comments' => $validated['new_books_on_time_comments'],
            'mr_contact_comments' => $validated['mr_contact_comments'],
            'improve_our_service_comments' => $validated['improve_our_service_comments'],

        ];



        LibraryReport::whereId($id)->update($credentials);


        return back()->with('message', 'Library visit Updated Successfully!');

        }

}

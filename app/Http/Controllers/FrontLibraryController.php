<?php

namespace App\Http\Controllers;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;
use App\Models\LibraryReport;
use App\Models\Officer;
use App\Models\Upazila;
use Illuminate\Support\Facades\Session;

class FrontLibraryController extends Controller
{
    public function LibraryReport()
    {


        $officer = Session::get('officer');
        if ($officer) {
        $divisions = Division::orderBy('division_name', 'ASC')->get();
        $officers=Officer::all();
        }else {
            return redirect()->route('officer.login');
        }

        return view("frontend.layouts.library_report.library_report", compact('divisions', 'officers'));
    }


    public function SuccessPage()
    {
        return view("frontend.layouts.library_report.success");
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



    public function Library_visit_new_front_Action(Request $request)
    {

        $validated = $request->validate([
            'library_type' => 'required',
            'employee_id' => 'required',
            'library_name' => 'required',
            'owner_name' => 'required',
            'contact_number' => 'required|max:11|',
            'date' =>'required',
            'area' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
            'available_books' => 'required',
            'books_collected_from' => 'required',
            'sales_executive_comments' => 'nullable',


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


        ];
        LibraryReport::create($credentials);

        return redirect()->route('success.report')->with('message', 'Library Report added Successfully!');
    }

}

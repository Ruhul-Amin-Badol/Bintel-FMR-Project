<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Records;
use App\Models\Officer;
use OCILob;

class RecordsController extends Controller
{
    public function records_list(){



        $records=Records::get();
        //return view("dashboard.layouts.records.records-list")->with(compact('records',));

        $officers=Officer::all();



        return view('dashboard.layouts.records.records-list', ['officers' => $officers]);
        // $officers = Officer::all(); //

        // return view('dashboard.layouts.records.records-list', compact('officers'));
    }


    public function delete_records(Request $request){

       $id=decrypt($request->id);
       Records::whereId($id)->delete();
       return back()->with('message', 'Records Deleted Successfully!');

    }

    public function edit_records(Request $request){


       // dd(decrypt($request->id));
        $id=decrypt($request->id);
        $record=Records::whereId($id)->first();
        $emp=Officer::all();
        return view("dashboard.layouts.records.records-edit")->with(compact('record','emp'));

    }


    public function records_list_by_date(Request $request)
    {
        $range = explode(" - ", $request->range);

        if (count($range) !== 2) {
            // Handle invalid date range format
            // You might want to return an error message or handle this case accordingly.
        }

        // Use Carbon for date manipulation (assuming you have it installed)
        $start = \Carbon\Carbon::parse($range[0])->format("Y-m-d");
        $end = \Carbon\Carbon::parse($range[1])->format("Y-m-d");

        $employeeName = $request->input('employeeName');

        $query = Records::query();

        if ($employeeName) {
            $query->where('employee_id', $employeeName);
        }

        // Apply date range filter
        $query->whereBetween('collection_date', [$start, $end]);

        $records = $query->get();

        $totalcost = $records->sum('cost');
        $totalinstitute = $records->sum('institute');
        $totalinstitutes = $records->sum('others_institute');
        $totallibrary = $records->sum('library');
        $totalteacher = $records->sum('teacher');
        $totalstudent = $records->sum('student');
        $totalbooks = $records->sum('books_count');
        $totalquiz = $records->sum('quiz');

        $officers = Officer::all();

        return view('dashboard.layouts.records.records-report', compact(
            'records',
            'totalinstitute',
            'totalinstitutes',
            'totalteacher',
            'totallibrary',
            'totalbooks',
            'totalcost',
            'officers'
        ));
    }



    public function edit_records_Action(Request $request){


        $id=decrypt($request->id);


        $validated = $request->validate([
            'collection_date' => 'required',
            'employee_id' => 'required',
            'location' => 'required',
            'cost' => 'required',
            'institute' => 'required',
            'others_institute' => 'required',
            'library' => 'required',
            'teacher' => 'required',
            'student' => 'required',
            'books_count' => 'required',
            'quiz' => 'required',
            'comments' => 'nullable',
        ]);

        $credentials = [
            'collection_date' => date("Y-m-d",strtotime($validated['collection_date'])),
            'employee_id' => $validated['employee_id'],
            'location' => $validated['location'],
            'cost' => $validated['cost'],
            'institute' => $validated['institute'],
            'others_institute' => $validated['others_institute'],
            'library' => $validated['library'],
            'teacher' => $validated['teacher'],
            'student' => $validated['student'],
            'books_count' => $validated['books_count'],
            'quiz' => $validated['quiz'],
            'comments' => $validated['comments'],
        ];

        Records::whereId($id)->update($credentials);


        return back()->with('message', 'Records Updated Successfully!');

        }

        // public function records_new(){
        //     $officers=Officer::all();
        //     $records = Records::latest()->take(5)->get();

        //     return view("dashboard.layouts.records.records-new",compact('officers','records'));

        // }

        public function records_new_Action( Request $request){

            $validated = $request->validate([
                'collection_date' => 'required',
                'employee_id' => 'required',
                'location' => 'required',
                'cost' => 'required',
                'institute' => 'required',
                'others_institute' => 'required',
                'library' => 'required',
                'teacher' => 'required',
                'student' => 'required',
                'books_count' => 'required',
                'quiz' => 'required',

                'comments' => 'nullable',
            ]);

            $credentials = [
                'collection_date' => date("Y-m-d",strtotime($validated['collection_date'])),
                'employee_id' => $validated['employee_id'],
                'location' => $validated['location'],
                'cost' => $validated['cost'],
                'institute' => $validated['institute'],
                'others_institute' => $validated['others_institute'],
                'library' => $validated['library'],
                'teacher' => $validated['teacher'],
                'student' => $validated['student'],
                'books_count' => $validated['books_count'],
                'quiz' => $validated['quiz'],
                'comments' => $validated['comments'],
            ];

           Records::create($credentials);
            return back()->with('message', 'Data Recorded Successfully!');

        }


        public function records_new_Ajax(Request $request)
        {
            $validated = $request->validate([
                'collection_date' => 'required',
                'employee_id' => 'required',
                'location' => 'required',
                'cost' => 'required',
                'institute' => 'required',
                'others_institute' => 'required',
                'library' => 'required',
                'teacher' => 'required',
                'student' => 'required',
                'books_count' => 'required',
                'quiz' => 'required',
                'comments' => 'nullable',
            ]);

            $credentials = [
                'collection_date' => date("Y-m-d",strtotime($validated['collection_date'])),
                'employee_id' => $validated['employee_id'],
                'location' => $validated['location'],
                'cost' => $validated['cost'],
                'institute' => $validated['institute'],
                'others_institute' => $validated['others_institute'],
                'library' => $validated['library'],
                'teacher' => $validated['teacher'],
                'student' => $validated['student'],
                'books_count' => $validated['books_count'],
                'quiz' => $validated['quiz'],
                'comments' => $validated['comments'],
            ];

            Records::create($credentials);

            return response()->json([
                'message' => 'Data Recorded Successfully!',
            ]);
        }


        public function recordsAjax(Request $request){

            // dd($request->all());
            $column = array(
                'collection_date',
                'employee_id',
                'location',
                'cost',
                'institute',
                'others_institute',
                'library',
                'teacher',
                'student',
                'books_count',
                'quiz',
                'comments'

            );
            $draw = $request->draw;
            $row = $request->start;
            $rowperpage = $request->length; // Rows display per page

            $columnIndex = $request->order[0]['column']; // Column index
            $columnName = empty($column[$columnIndex]) ? $column[0] : $column[$columnIndex];
            $columnSortOrder = $request->order[0]['dir']; // asc or desc
            $searchValue = $request->search['value']; // Search value

            $totalRecords = $totalDRecords = 0;
            $allData = [];

            if ($searchValue == '') {

                $records = Records::orderBy('created_at', 'desc')->skip($row)->take($rowperpage)->get();
                $totalRecords_count = Records::count();
                $totalRecords = $totalDRecords = !empty($totalRecords_count) ? $totalRecords_count : 0;
            }
            else {
                $records = Records::join('officers', 'records.employee_id', '=', 'officers.employee_id')->where('officers.name', 'like', '%' . $searchValue . '%')->orderBy($columnName, $columnSortOrder)->skip($row)->take($rowperpage)->get();
                $totalRecords_count =Records::where('employee_id', 'like', '%' . $searchValue . '%')->count();
                $totalRecords = $totalDRecords = !empty($totalRecords_count) ? $totalRecords_count : 0;
            }


            foreach ($records as $key => $record) {

                $data = [];
                $data[] = $record->collection_date ? date('d-m-Y', strtotime($record->collection_date)) : '' ;
                $data[] = !empty($record->employee) ? $record->employee->name . " (" . $record->employee->employee_id . ")" : "Unknown";
                $data[] = $record->location;
                $data[] = $record->cost.'৳' ;
                $data[] = $record->institute;
                $data[] = "<p>" . $record->others_institute . "</p>";
                $data[] = $record->library;
                $data[] = $record->teacher;
                $data[] = $record->student;
                $data[] = $record->books_count;
                $data[] = $record->quiz;
                $data[] = $record->comments;
                $data[] =date("d/m/y g:i:s A",strtotime($record->created_at));
                $data[] = '<a class="me-3" href="'.route("records.edit",encrypt($record->id)).'">
                <img src="'.asset('resources/assets/img/icons/edit.svg').'" alt="img">
            </a>
            <a class="me-3 delete-btn" href="'.route("records.delete",encrypt($record->id)).'">
                <img src="'.asset('resources/assets/img/icons/delete.svg') .'" alt="img">
            </a>';

                $allData[] = $data;
            }


            /// Response
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalDRecords,
                "aaData" => $allData
            );

            return response()->json($response);

        }



}

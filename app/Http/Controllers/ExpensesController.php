<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expenses;
use App\Models\Officer;
use Carbon\Carbon;




class ExpensesController extends Controller
{
    public function expenses_list(Request $request){

        $expenses=Expenses::get();
        $officers=Officer::all();
        return view('dashboard.layouts.expenses.expenses-list', [
            'expenses' => $expenses,

            'officers' =>$officers,// Pass the total cost to the blade file
        ]);
        // return view("dashboard.layouts.expenses.expenses-list")->with(compact('expenses'));


    }


    public function monthlyReport(Request $request){

        $expenses=Expenses::get();
        $officers=Officer::all();
        return view('dashboard.layouts.expenses.monthly-report', ['expenses' => $expenses,

            'officers' =>$officers,// Pass the total cost to the blade file
        ]);

    }

    /* public function expenses_list_by_date(Request $request)
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

        $employeeName = $request->input('employeeName');


        $query = Expenses::query();

        if ($employeeName) {
            $query->where('employee_id', $employeeName);
        }



        // Apply date range filter
        $query->whereRaw('DATE(expenses_date) BETWEEN ? AND ?', [$start, $end]);

        $expenses = $query->get();

        //dd($expenses);

        $totalcost = $expenses->sum('total_cost');

        $officers = Officer::all();

        return view('dashboard.layouts.expenses.expenses-report', compact('expenses', 'totalcost', 'officers'));
    } */



    public function delete_expenses(Request $request){

       $id=decrypt($request->id);
      Expenses::whereId($id)->delete();
       return back()->with('message', 'Expenses Deleted Successfully!');

    }

    public function edit_expenses(Request $request){

        $id=decrypt($request->id);
        $expense=Expenses::whereId($id)->first();
        $emp=Officer::all();
        return view("dashboard.layouts.expenses.expenses-edit")->with(compact('expense','emp'));

    }

    public function edit_expenses_Action(Request $request){


        $id=decrypt($request->id);

        $validated = $request->validate([
            'expenses_date' => 'required',
            'employee_id' => 'required',
            'type' => 'required',
            'total_cost' => 'required',
            'comments' => 'nullable',
        ]);

        $credentials = [
            'expenses_date' => date("Y-m-d",strtotime($validated['expenses_date'])),
            'employee_id' => $validated['employee_id'],
            'type' => $validated['type'],
            'total_cost' => $validated['total_cost'],
            'comments' => $validated['comments'],

        ];

        Expenses::whereId($id)->update($credentials);


        return back()->with('message', 'Expenses Updated Successfully!');

        }

        // public function expenses_new(){
        //     $officers=Officer::all();


        //     return view("dashboard.layouts.expenses.expenses-new",compact('officers'));

        // }

        public function expenses_new_Action(Request $request) {
            $validated = $request->validate([
                'expenses_date' => 'required',
                'employee_id' => 'required',
                'TA' => 'nullable',
                'DA' => 'nullable',
                'Convenience' => 'nullable',
                'Rent' => 'nullable',
                'Others' => 'nullable',
            ]);

            $expenseFields = ['TA', 'DA', 'Convenience', 'Rent', 'Others'];
            $expenseTypes = ['TA', 'DA', 'Convenience', 'Rent', 'Others'];

            foreach ($expenseFields as $index => $field) {
                if (isset($request->$field)) {
                    $credentials = [
                        'expenses_date' => date("Y-m-d",strtotime($validated['expenses_date'])),
                        'employee_id' => $validated['employee_id'],
                        'type' => $expenseTypes[$index],
                        'total_cost' => $validated[$field],
                        'comments' => $request->input("comment$field"),
                    ];

                    Expenses::create($credentials);
                }
            }

            return back()->with('message', 'Data Expenses Added Successfully!');
        }


        public function expenses_new_Ajax(Request $request)
{

   // dd($request->all());
    $validated = $request->validate([
        'expenses_date' => 'required',
        'employee_id' => 'required',
        'TA' => 'nullable',
        'DA' => 'nullable',
        'Convenience' => 'nullable',
        'Rent' => 'nullable',
        'Others' => 'nullable',
    ]);

    $expenseFields = ['TA', 'DA', 'Convenience', 'Rent', 'Others'];
    $expenseTypes = ['TA', 'DA', 'Convenience', 'Rent', 'Others'];

    foreach ($expenseFields as $index => $field) {
        if (isset($validated[$field]) && !empty($validated[$field])) {
            $credentials = [
                'expenses_date' => date("Y-m-d",strtotime($validated['expenses_date'])),
                'employee_id' => $validated['employee_id'],
                'type' => $expenseTypes[$index],
                'total_cost' => $validated[$field],
                'comments' => $request->input("comment$field"),
            ];

            Expenses::create($credentials);
        }
    }

    return response()->json([
        'message' => 'Data Expenses Added Successfully!'
    ]);
}


        public function expensesAjax(Request $request){


            $column = array(
                'expenses_date',
                'employee_id',
                'type',
                'total_cost',
                'comments',
                "created_at"

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

                $expenses = Expenses::orderBy('created_at', 'desc')->skip($row)->take($rowperpage)->get();
                $totalRecords_count = Expenses::count();
                $totalRecords = $totalDRecords = !empty($totalRecords_count) ? $totalRecords_count : 0;
            }
            else {
                $expenses = Expenses::join('officers', 'expenses.employee_id', '=', 'officers.employee_id')->where('officers.name', 'like', '%' . $searchValue . '%')->orderBy($columnName, $columnSortOrder)->skip($row)->take($rowperpage)->get();
                $totalRecords_count =Expenses::where('employee_id', 'like', '%' . $searchValue . '%')->count();
                $totalRecords = $totalDRecords = !empty($totalRecords_count) ? $totalRecords_count : 0;
            }

            foreach ($expenses as $key => $expense) {

                $data = [];



                $data[] = date('d-m-Y', strtotime($expense->expenses_date));
                $data[] = isset($expense->employee)? $expense->employee->name."($expense->employee_id)":"";   //!empty($expense->employee) ? $$expense->employee->name . " (" . $$expense->employee->employee_id . ")" : "Unknown";
                $data[] = $expense->type;
                $data[] = $expense->total_cost.'৳';
                $data[] = $expense->comments;
                $data[] =date("d/m/y g:i:s A",strtotime($expense->created_at));
                $data[] = '<a class="me-3" href="'.route("expenses.edit",encrypt($expense->id)).'">
                <img src="'.asset('resources/assets/img/icons/edit.svg').'" alt="img">
            </a>
            <a class="me-3 delete-btn" href="'.route("expenses.delete",encrypt($expense->id)).'">
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

            echo json_encode($response);

        }



        public function monthly_Report_Ajax(Request $request){

            $officers = Officer::all();
            // $expense = Expenses::all();
            $data = [];
            $grandTotal = 0;

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

            foreach ($officers as $officer) {
                // Calculate expenses for each type
                $ta = Expenses::where('employee_id', $officer->employee_id)->where("type", "TA")->whereDate("expenses_date", ">=", $start)->whereDate("expenses_date", "<=", $end)->sum("total_cost");
                $da = Expenses::where('employee_id', $officer->employee_id)->where("type", "DA")->whereDate("expenses_date", ">=", $start)->whereDate("expenses_date", "<=", $end)->sum("total_cost");
                $rent = Expenses::where('employee_id', $officer->employee_id)->where("type", "Rent")->whereDate("expenses_date", ">=", $start)->whereDate("expenses_date", "<=", $end)->sum("total_cost");
                $con = Expenses::where('employee_id', $officer->employee_id)->where("type", "Convenience")->whereDate("expenses_date", ">=", $start)->whereDate("expenses_date", "<=", $end)->sum("total_cost");
                $ot = Expenses::where('employee_id', $officer->employee_id)->where("type", "Others")->whereDate("expenses_date", ">=", $start)->whereDate("expenses_date", "<=", $end)->sum("total_cost");
                $total_cost = Expenses::where('employee_id', $officer->employee_id)->whereDate("expenses_date", ">=", $start)->whereDate("expenses_date", "<=", $end)->sum("total_cost");
                $data[] = array(
                    "name" => $officer->name,
                    "employee_id" => $officer->employee_id,
                    "designation" => $officer->designation ?? 'Field Marketing',
                    "ta" => $ta,
                    "da" => $da,
                    "rent" => $rent,
                    "con" => $con,
                    "ot" => $ot,
                    "total_cost" => $total_cost
                );

                $grandTotal += $total_cost;
            }



            return view('dashboard.layouts.expenses.monthly-report', compact('data','officers','grandTotal'));

        }


        public function expenses_list_by_date(Request $request)
    {

        $range = $request->range;
        $dateArray = array();
        $grandTotal = 0;
        $data = [];
        if ($range) {
            $dateRange = explode(" - ", $range);
            $start = date("Y-m-d", strtotime($dateRange[0]));
            $end = date("Y-m-d", strtotime($dateRange[1]));

            $currentDate = $start;
            while ($currentDate <= $end) {
                $dateArray[] = $currentDate;
                $currentDate = date("Y-m-d", strtotime($currentDate . "+1 day"));
            }
        } else {
            // Default to the current month if range is not provided
            $start = date("Y-m-01");
            $end = date("Y-m-t");

            $currentDate = $start;
            while ($currentDate <= $end) {
                $dateArray[] = $currentDate;
                $currentDate = date("Y-m-d", strtotime($currentDate . "+1 day"));
            }
        }

        $id = $request->input('employeeName');

        foreach($dateArray as $single){

                $ta = Expenses::where('employee_id', $id)->where("type", "TA")->whereDate("expenses_date", $single)->sum("total_cost");
                $da = Expenses::where('employee_id', $id)->where("type", "DA")->whereDate("expenses_date", $single)->sum("total_cost");
                $rent = Expenses::where('employee_id', $id)->where("type", "Rent")->whereDate("expenses_date", $single)->sum("total_cost");
                $con = Expenses::where('employee_id', $id)->where("type", "Convenience")->whereDate("expenses_date", $single)->sum("total_cost");
                $ot = Expenses::where('employee_id', $id)->where("type", "Others")->whereDate("expenses_date", $single)->sum("total_cost");
                $total_cost = Expenses::where('employee_id', $id)->whereDate("expenses_date", $single)->sum("total_cost");

                $data[$single] = array(
                    "ta" => $ta,
                    "da" => $da,
                    "rent" => $rent,
                    "con" => $con,
                    "ot" => $ot,

                    "total_cost" => $total_cost
                );

                $grandTotal += $total_cost;
// dd($grandTotal);

        }
        // dd($data);


        $officers = Officer::all();

        // $total_cost=array_sum($data["total_cost"]);
        $employee= Officer::where('employee_id',$id)->first();

        return view('dashboard.layouts.expenses.expenses-report', compact('employee', 'data','officers','grandTotal'));
    }
  
  public function edit_expenses_report(Request $request){

            $id=$request->id;
            $date=$request->date;
            $expense=Expenses::where('employee_id',$id)->whereDate('expenses_date',$date)->get();

           return view("dashboard.layouts.expenses.expenses-report-edit")->with(compact('expense'));

        }


        public function edit_expenses_report_Action(Request $request) {


            $exp=Expenses::find($request->id);

            $exp->expenses_date = date('Y-m-d', strtotime($request->expenses_date));
            $exp->total_cost=$request->total_cost;
            $exp->comments=$request->comment;
            $exp->save();


            return response()->json([
                'message' => 'Data Expenses Added Successfully!',
                'redirect' => route('expenses.list'),
            ]);



        }


        public function delete_expenses_report(Request $request)
        {

            $id=$request->id;
            $date=$request->date;
            $expense=Expenses::where('employee_id',$id)->whereDate('expenses_date',$date)->delete();

            return redirect()->back()->with('message', 'Expenses Deleted Successfully!');
        }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Officer;
use App\Models\Test;

class TestController extends Controller
{
 public function testAjax(Request $request){

    // dd($request->all());
    $column = array(
        'employee_id',
        'name',
        'phone',
        'area',
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

        $test = Officer::orderBy($columnName, $columnSortOrder)->skip($row)->take($rowperpage)->get();
        $totalRecords_count = Officer::count();
        $totalRecords = $totalDRecords = !empty($totalRecords_count) ? $totalRecords_count : 0;
    }
    else {
        $test = Officer::where('name', 'like', '%' . $searchValue . '%')->orderBy($columnName, $columnSortOrder)->skip($row)->take($rowperpage)->get();
        $totalRecords_count =Officer::where('name', 'like', '%' . $searchValue . '%')->count();
        $totalRecords = $totalDRecords = !empty($totalRecords_count) ? $totalRecords_count : 0;
    }
    foreach ($test as $key => $officer) {



        $data = [];

        $data[] = '<label class="checkboxs"><input type="checkbox" data-value="' . $officer->id . '"><span class="checkmarks"></span></label>';
        $data[] = $officer->name."($officer->employee_id)";
        $data[] = $officer->phone;
        $data[] = "<p>" . $officer->area . "</p>";
        $data[] =date("d/m/y g:i:s A",strtotime($officer->created_at));
        $data[] = "<p>action</p>";
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




public function test_list(){
    return view('dashboard.layouts.test.test-list');
}


 }



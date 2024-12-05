<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Officer;

class OfficersController extends Controller
{
    public function officers_list()
    {

        $officers = Officer::get();
        return view("dashboard.layouts.officers.officer-list")->with(compact('officers'));
    }


    public function delete_officers(Request $request)
    {

        $id = decrypt($request->id);
        Officer::whereId($id)->delete();
        return back()->with('message', 'Officers Deleted Successfully!');
    }

    public function edit_officers(Request $request)
    {

        $id = decrypt($request->id);
        $officer = Officer::whereId($id)->first();
        return view("dashboard.layouts.officers.officer-edit")->with(compact('officer'));
    }


    public function edit_officers_Action(Request $request)
{
    $id = decrypt($request->id);

    $validated = $request->validate([
        'employee_id' => 'required',
        'name' => 'required',
        'designation' => 'required',
        'phone' => 'required|max:11|',
        'area' => 'required',
        'password' => 'nullable',
    ]);

    $credentials = [
        'employee_id' => $validated['employee_id'],
        'name' => $validated['name'],
        'designation' => $validated['designation'],
        'phone' => $validated['phone'],
        'area' => $validated['area'],
    ];

    // Encrypt password only if provided
    if (!empty($validated['password'])) {
        $credentials['password'] = bcrypt($validated['password']);
    }

    Officer::whereId($id)->update($credentials);

    return back()->with('message', 'Profile Updated Successfully!');
}


    public function officers_new()
    {


        return view("dashboard.layouts.officers.officer-new");
    }

    public function officers_new_Action(Request $request)
{
    $validated = $request->validate([
        'employee_id' => 'required',
        'name' => 'required',
        'designation' => 'required',
        'phone' => 'required|max:11|',
        'area' => 'required|min:1|max:200',
        'password' => 'nullable',
    ]);

    $credentials = [
        'employee_id' => $validated['employee_id'],
        'name' => $validated['name'],
        'designation' => $validated['designation'],
        'phone' => $validated['phone'],
        'area' => $validated['area'],
        'password' => $validated['password'] ? bcrypt($validated['password']) : null,
        'is_officer' => 1,
    ];

    Officer::create($credentials);

    return back()->with('message', 'Officer added Successfully!');
}




    public function officersAjax(Request $request)
    {

        // dd($request->all());
        $column = array(
            'employee_id',
            'name',
            'designation',
            'phone',
            'area',
            'password',
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

            $officers = Officer::orderBy($columnName, $columnSortOrder)->skip($row)->take($rowperpage)->get();
            $totalRecords_count = Officer::count();
            $totalRecords = $totalDRecords = !empty($totalRecords_count) ? $totalRecords_count : 0;
        } else {
            $officers = Officer::where('name', 'like', '%' . $searchValue . '%')->orderBy($columnName, $columnSortOrder)->skip($row)->take($rowperpage)->get();
            $totalRecords_count = Officer::where('name', 'like', '%' . $searchValue . '%')->count();
            $totalRecords = $totalDRecords = !empty($totalRecords_count) ? $totalRecords_count : 0;
        }
        foreach ($officers as $key => $officer) {

            $data = [];
            $data[] = $officer->employee_id;
            $data[] = $officer->name . "($officer->employee_id)";
            $data[] = $officer->designation ?? 'Field Marketing';
            $data[] = $officer->phone;
            $data[] = "<p>" . $officer->area . "</p>";
            
            $data[] = date("d/m/y g:i:s A", strtotime($officer->created_at));
            $data[] = '<a class="me-3" href="' . route("officers.edit", encrypt($officer->id)) . '">
                <img src="' . asset('resources/assets/img/icons/edit.svg') . '" alt="img">
            </a>
            <a class="me-3 delete-btn" href="' . route("officers.delete", encrypt($officer->id)) . '">
                <img src="' . asset('resources/assets/img/icons/delete.svg') . '" alt="img">
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
}

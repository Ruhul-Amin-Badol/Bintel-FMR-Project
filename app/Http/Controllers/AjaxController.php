<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Route;

class AjaxController extends Controller
{

    public function change_admin_status(Request $request)
    {

        $id = decrypt($request->id);
        $data = User::whereId($id)->first();
        if ($data) {
            $status = $data->status;
            if ($status == 1) {
                //disble it
                $data = User::where('id', $id)->update(['status' => 0]);
            } else {
                //enable it
                $data = User::where('id', $id)->update(['status' => 1]);
            }

            return response()->json(array('message' => "updated"), 200);
        } else {

            return response()->json(array('message' => "error"), 200);
        }
    }


    public function route_list(Request $request)
    {



        $search = empty($request->q) ? "" : $request->q;
        $select2Json = [];

        $route_name = [];

        foreach (Route::getRoutes()->getRoutes() as $route) {
            $action = $route->uri();
            if(str_contains($action, 'dashboard'))
            $route_name[]=$action;

        }


        if (!empty($route_name)) {

            foreach($route_name as $url) {

                if(str_contains($url, $search))
                $select2Json[] = array(
                    'id' => $url,
                    'text' => $url
                );

            }
        }
         echo html_entity_decode(json_encode($select2Json));

    }
}

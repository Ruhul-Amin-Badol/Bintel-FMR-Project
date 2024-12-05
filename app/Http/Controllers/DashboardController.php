<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Options;

class DashboardController extends Controller
{
    //home page


    public function home(){

       return view('dashboard.layouts.home');
    }

    public function profile(){
        return view("dashboard.layouts.profile");
    }

    public function update_image(Request $request){


        $id=Auth::user()->id;

        $validated = $request->validate([
            'images'=> 'required|mimes:jpeg,jpg,png|max:10000',
        ]);

        if( isset($request['images']) ){

            $path ="public/uploads/".date("Y")."/".date("m")."/".date("d")."/";
            $imageName = time().'.'.$request->images->extension();
            $request->images->move($path, $imageName);
            $credentials = [
                'images' => $path.$imageName,
            ];
            DB::table('users')->whereId($id)->update($credentials);

        }

         return back()->with('message', 'Profile Picture Updated Successfully!');




    }

    public function update_profile(Request $request){

        $id=Auth::user()->id;

        $validated = $request->validate([
            'user_name' => 'required|min:2|max:15|unique:users,user_name,'.$id,
            'user_mobile' => 'required|min:11|max:11|unique:users,user_mobile,'.$id,
            'email' => 'email|required|min:4|unique:users,email,'.$id,
            'user_role' => 'required',
            'name' => 'required|min:3|max:20',
            'password'=>'nullable|min:4|max:15',
        ]);

        $credentials = [
            'user_name' => $validated['user_name'],
            'email' => $validated['email'],
            'user_role' => decrypt($validated['user_role']),
            'user_mobile' => $validated['user_mobile'],
            'name' => $validated['name'],

        ];

        DB::table('users')->whereId($id)->update($credentials);


        if( !empty($request['password']) ){

            $credentials = [
                'password' => Hash::make($validated['password']),
            ];

            DB::table('users')->whereId($id)->update($credentials);
        }

        return back()->with('message', 'Profile Updated Successfully!');

    }

    public function admin_list(){

        $admins=User::get();
        return view("dashboard.layouts.admin-list")->with(compact('admins'));

    }

    public function delete_admin(Request $request){

       $id=decrypt($request->id);
       User::whereId($id)->delete();
       //DB::table("users")->whereId($id)->delete();
       return back()->with('message', 'Admin Deleted Successfully!');

    }

    public function edit_admin(Request $request){

        $id=decrypt($request->id);
        $admin=User::whereId($id)->first();
        return view("dashboard.layouts.admin-edit")->with(compact('admin'));

    }

    public function edit_admin_Action(Request $request){


        $id=decrypt($request->id);

        $validated = $request->validate([
            'user_name' => 'required|min:2|max:15|unique:users,user_name,'.$id,
            'user_mobile' => 'required|unique:users,user_mobile,'.$id,
            'email' => 'email|required|min:4|unique:users,email,'.$id,
            'user_role' => 'required|integer',
            'name' => 'required|min:3|max:20',
            'password'=>'nullable|min:4|max:14',
            'images'=> 'nullable|mimes:jpeg,jpg,png|max:10000',
        ]);

        $credentials = [
            'user_name' => $validated['user_name'],
            'user_mobile' => $validated['user_mobile'],
            'email' => $validated['email'],
            'user_role' => $validated['user_role'],
            'name' => $validated['name'],

        ];

        User::whereId($id)->update($credentials);

        if( isset($request['images']) ){

            $path ="public/uploads/".date("Y")."/".date("m")."/".date("d")."/";
            $imageName = time().'.'.$request->images->extension();

            $request->images->move($path, $imageName);

            $credentials = [
                'images' => $path.$imageName,
            ];

            User::whereId($id)->update($credentials);


        }

        if( !empty($request['password']) ){

            $credentials = [
                'password' => Hash::make($validated['password']),
            ];

            User::whereId($id)->update($credentials);
        }

        return back()->with('message', 'Profile Updated Successfully!');

        }

        public function admin_new(){


            return view("dashboard.layouts.admin-new");

        }

        public function admin_new_Action( Request $request){

            // dd($request->all());
            $validated = $request->validate([
                'user_name' => 'required|min:2|max:15|unique:users',
                'user_mobile' => 'required|unique:users',
                'email' => 'email|required|min:4|unique:users',
                'user_role' => 'required|integer',
                'name' => 'required|min:3|max:20',
                'password'=>'required|min:4|max:15',
                'images'=> 'nullable|mimes:jpeg,jpg,png|max:10000',
            ]);

             $image_name="public/uploads/defaults.png";

            if( isset($request['images']) ){

                $path ="public/uploads/".date("Y")."/".date("m")."/".date("d")."/";
                $imageName = time().'.'.$request->images->extension();

                $request->images->move($path, $imageName);

                $image_name= $path.$imageName;

            }


            $credentials = [
                'user_name' => $validated['user_name'],
                'user_mobile' => $validated['user_mobile'],
                'email' => $validated['email'],
                'user_role' => $validated['user_role'],
                'name' => $validated['name'],
                'password' => Hash::make($validated['password']),
                'images' => $image_name,
                'is_admin'=>1
            ];

            User::create($credentials);
            return back()->with('message', 'Admin added Successfully!');

        }

        public function setting(){

            $option=Options::all();
           // dd($option);
            return view('dashboard.layouts.setting.index',compact('option'));
        }

        public function settingStore(Request $request){

            $option=Options::where('name','=',$request->name)->get()->first();
            $option->value=$request->value;
            if( empty($option->value) ){
               // $option->delete();
                echo json_encode(array("status"=>"2",
                "message"=>"Option: ".$request->name." has been deleted",));
            }
            else{
                $option->update();
                echo json_encode(array("status"=>"1",
                "message"=>"Option: ".$request->name." has been updated!",));
            }


        }

        public function settingStoreNew(Request $request){
            $option=new Options();

            $option->name=$request->name;
            $option->value=$request->value;
            $option->save();
            return back()->with('message', 'Option added');

        }

}

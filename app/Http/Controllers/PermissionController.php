<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Template;
use App\Models\Sender;
use App\Models\Permission;
use App\Models\Role;
use Exception;
use Faker\Provider\ar_EG\Person;

class PermissionController extends Controller
{
    public function index()
    {

        $permission=Permission::all();
        return view('dashboard.layouts.permission.index',compact('permission'));
    }
    public function store(Request $request){

        $validated = $request->validate([
            'name' => 'required',
            'routes' => 'required'
        ]);

        $permission = new Permission();

        $permission->name= $validated['name'];
        $permission->slug= implode(',',$validated['routes']);
        $permission->save();
        return back()->with('message', 'Successfully added!');
    
        //dd($request->all());

    }


    public function destroy(Request $request){

        try{
            $id=decrypt($request->id);
            $permission=Permission::find($id);
            if( $permission){
                $permission->delete();
                return back()->with('message', 'Deleted Successfully!');
            }
            else{
                return back()->with('message', 'Error')->with('type','error');
            }
        }
        catch(Exception $e){

            return back()->with('message', 'Invalid')->with('type','error');
        }
        

     }


     public function destroyALL(Request $request){

        try{
            $token=base64_decode($request->get("token"));
  
            $ids=json_decode($token);
      
            foreach($ids as $i){
      
                Permission::find($i)->delete();
      
            }
            return back()->with('message', 'Successfully Deleted.');
          
        }
        catch(Exception $e){

            return back()->with('message', 'Error')->with('type','error');
        }
        
  
      }

      public function update(Request $request){

        $id=decrypt($request->id);
        $permission=Permission::whereId($id)->get()->first();
        
        return view('dashboard.layouts.permission.update',compact('permission'));
    }

    public function updateAction(Request $request){

        $id=decrypt($request->id);

        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required'
        ]);

            $permission=Permission::find($id);
            $permission->name= $validated['name'];
            $permission->slug= implode(',',$validated['slug']);
            $permission->update();

            return redirect()->route('permission.index')->with('message', 'Updated Successfully!');
      }


      public function roles_index()
        {

            $role=Role::all();
            $permission=Permission::orderBy('name', 'asc')->get();
            return view('dashboard.layouts.role.index',compact('role','permission'));
        }


        public function roles_destroy(Request $request){

            try{
                $id=decrypt($request->id);
                $role=Role::find($id);
                if( $role){
                    $role->delete();
                    return back()->with('message', 'Deleted Successfully!');
                }
                else{
                    return back()->with('message', 'Error')->with('type','error');
                }
            }
            catch(Exception $e){
    
                return back()->with('message', 'Invalid')->with('type','error');
            }
            
    
         }
    
    
         public function roles_destroyALL(Request $request){
    
            try{
                $token=base64_decode($request->get("token"));
      
                $ids=json_decode($token);
          
                foreach($ids as $i){
          
                    Role::find($i)->delete();
          
                }
                return back()->with('message', 'Successfully Deleted.');
              
            }
            catch(Exception $e){
    
                return back()->with('message', 'Error')->with('type','error');
            }
            
      
          }

          public function roles_store(Request $request){

            $validated = $request->validate([
                'name' => 'required',
                'permission' => 'required'
            ]);
    
            $role = new Role();
    
            $role->name= $validated['name'];
            $role->permissions= implode(',',$validated['permission']);
            $role->uid= Auth::user()->id;
            $role->save();
            return back()->with('message', 'Successfully added!');
    
    
        }



        public function roles_update(Request $request){

            $id=decrypt($request->id);
            $role=Role::whereId($id)->get()->first();
            $permission=Permission::orderBy('name', 'asc')->get();
            return view('dashboard.layouts.role.update',compact("role",'permission'));
        }
    
        public function roles_updateAction(Request $request){

            
    
            $id=decrypt($request->id);
    
            $validated = $request->validate([
                'name' => 'required',
                'permission' => 'required'
            ]);
    
                $role=Role::find($id);
                $role->name= $validated['name'];
                $role->permissions= implode(',',$validated['permission']);
                $role->uid= Auth::user()->id;
                $role->update();
    
                return redirect()->route('roles.index')->with('message', 'Updated Successfully!');
          }



}

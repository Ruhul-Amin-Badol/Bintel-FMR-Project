<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Template;
use App\Models\Sender;
use Exception;

class TemplateController extends Controller
{
 

   public function index()
    {
        $template=Template::all();
        return view('dashboard.layouts.template.index',compact('template'));
    }
     public function create(){

        $sender = Sender::all();
        
        return view('dashboard.layouts.template.create',compact('sender'));
     }

     public function store(Request $request){

        $validated = $request->validate([
            'name' => 'required|unique:templates',
            'sender' => 'required',
            'content' => 'required',
        ],[
            'name.unique'=>'Template already exsists'
        ]);
     
        $credentials = [
            'name' => $validated["name"],
            'sender' => $validated["sender"],
            'content' => $validated["content"],
            'created_by'=>Auth::user()->id,
           
        ];

        Template::create($credentials);
        return redirect()->route('template.index')->with('message', 'Template added Successfully!');

     }


     public function destroy(Request $request){

        try{
            $id=decrypt($request->id);
            $template=Template::find($id);
            if($template){
                $template->delete();
                return back()->with('message', 'Deleted Successfully!');
            }
            else{
                return back()->with('message', 'Error')->with('type','error');
            }
        }
        catch(Exception $e){

            return back()->with('message', 'Invalid Template')->with('type','error');
        }
        

     }


     public function destroyALL(Request $request){

        try{
            $token=base64_decode($request->get("token"));
  
            $ids=json_decode($token);
      
            foreach($ids as $i){
      
                Template::find($i)->delete();
      
            }
            return back()->with('message', 'Successfully Deleted.');
          
        }
        catch(Exception $e){

            return back()->with('message', 'Error')->with('type','error');
        }
        
  
      }

      public function update(Request $request){

            $id=decrypt($request->id);
            $template=Template::whereId($id)->get()->first();
            $sender = Sender::all();
            //dd($template->name);
            return view('dashboard.layouts.template.update',compact('sender','template'));
      }

      public function updateAction(Request $request){

        //dd($request->all());

        $validated = $request->validate([
            'name' => 'required',
            'sender' => 'required',
            'content' => 'required',
        ],[
            'name.unique'=>'Template already exsists'
        ]);
     
        $credentials = [
            'name' => $validated["name"],
            'sender' => $validated["sender"],
            'content' => $validated["content"],
            'created_by'=>Auth::user()->id,
           
        ];

            $id=decrypt($request->id);
            $template=Template::find($id);
            $template->update($credentials);

        return back()->with('message', 'Updated');
      }

}

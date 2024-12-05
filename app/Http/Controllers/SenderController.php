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

class SenderController extends Controller
{
 

   public function index()
    {
        $sender=Sender::all();
        return view('dashboard.layouts.sender.index',compact('sender'));
    }
     
     public function store(Request $request){

        $validated = $request->validate([
            'name' => 'required',
            'sender_id' => 'required|unique:senders',
            'token' => 'min:0'
        ],[
            'sender_id.unique'=>'Sender already exsists'
        ]);
     
        $credentials = [
            'name' => $validated["name"],
            'sender_id' => $validated["sender_id"],
            'token' => $validated["token"],
           
        ];

        Sender::create($credentials);
        return redirect()->route('sender.index')->with('message', 'Sender added Successfully!');

     }


     public function destroy(Request $request){

        try{
            $id=decrypt($request->id);
            $sender=Sender::find($id);
            if($sender){
                $sender->delete();
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
      
                Sender::find($i)->delete();
      
            }
            return back()->with('message', 'Successfully Deleted.');
          
        }
        catch(Exception $e){

            return back()->with('message', 'Error')->with('type','error');
        }
        
  
      }

      public function update(Request $request){

            $id=decrypt($request->id);
            $sender=Sender::whereId($id)->get()->first();
            return view('dashboard.layouts.sender.update',compact('sender'));
      }

      public function updateAction(Request $request){

        $id=decrypt($request->id);

        $validated = $request->validate([
            'name' => 'required',
            'sender_id' => 'required|unique:senders,sender_id,'.$id,
            'token' => 'min:0'
        ],[
            'sender_id.unique'=>'Sender already exsists'
        ]);
     
        $credentials = [
            'name' => $validated["name"],
            'sender_id' => $validated["sender_id"],
            'token' => $validated["token"],
           
        ];

            
            $sender=Sender::find($id);
            $sender->update($credentials);

            return redirect()->route('sender.index')->with('message', 'Updated Successfully!');
      }

}

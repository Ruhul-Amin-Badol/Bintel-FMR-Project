<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Template;
use App\Models\Sender;
use App\Models\Log;
use Exception;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Contracts\Session\Session;

class SmsController extends Controller
{


    public function royal_index()
    {

        $template = Template::where('sender', '=', 1)->get();
        return view('dashboard.layouts.sms.royal', compact('template'));
    }

    public function royal_send(Request $request)
    {

        $validated = $request->validate([
            'numbers' => 'required|min:10',
            'message' => 'required|min:2',

        ]);

        $num = $validated['numbers'];
        $message = $validated['message'];
        $sender = Sender::whereId(1)->get()->first();
        $url = get_option("api_url");
        $api_key = $sender->token;
        $senderid = $sender->sender_id;
        $number = str_replace(" ", "", $num);
        $text = $message;

        $data = [
            "api_key" => $api_key,
            "senderid" => $senderid,
            "number" => $number,
            "message" => $text
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        $status = json_decode($response);

        if ($status->response_code == '202') {

            foreach (explode(",", $num) as $single) {

                $log = new Log();
                $log->phone_number = $single;
                $log->sender_id = $senderid;
                $log->sms = $text;
                $log->sent_by = Auth::user()->id;
                $log->save();
            }


            return back()->with('message', 'Sms has been sent successfully');
        } elseif ($status->response_code == '1007') {

            return back()->with('message', 'Balance Insufficient')->with('type', 'error');
        } else {

            return back()->with('message', 'Internal Error')->with('type', 'error');
        }
    }


    public function  csv(Request $request)
    {

        $validated = $request->validate([

            'csv' => 'required|file',

        ]);

        $file = $request->file('csv');
        $csv = [];
        $back_to = $request->back_to;

        //dd($file->getClientOriginalName());

        if (($handle = fopen($file->getPathName(), 'r')) !== FALSE) {
            // necessary if a large csv file
            set_time_limit(0);
            $row = 0;
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {

                $csv[] = $data[0];
                $row++;
            }
            fclose($handle);
        }

        $csv_text = implode(",", $csv);
        session()->put("csv", $csv_text);
        return redirect()->route($back_to)->with('message', 'Imported Successfully');
    }





    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'sender_id' => 'required|unique:senders',
            'token' => 'min:0'
        ], [
            'sender_id.unique' => 'Sender already exsists'
        ]);

        $credentials = [
            'name' => $validated["name"],
            'sender_id' => $validated["sender_id"],
            'token' => $validated["token"],

        ];

        Sender::create($credentials);
        return redirect()->route('sender.index')->with('message', 'Sender added Successfully!');
    }


    public function destroy(Request $request)
    {

        try {
            $id = decrypt($request->id);
            $sender = Sender::find($id);
            if ($sender) {
                $sender->delete();
                return back()->with('message', 'Deleted Successfully!');
            } else {
                return back()->with('message', 'Error')->with('type', 'error');
            }
        } catch (Exception $e) {

            return back()->with('message', 'Invalid Template')->with('type', 'error');
        }
    }


    public function destroyALL(Request $request)
    {

        try {
            $token = base64_decode($request->get("token"));

            $ids = json_decode($token);

            foreach ($ids as $i) {

                Sender::find($i)->delete();
            }
            return back()->with('message', 'Successfully Deleted.');
        } catch (Exception $e) {

            return back()->with('message', 'Error')->with('type', 'error');
        }
    }

    public function update(Request $request)
    {

        $id = decrypt($request->id);
        $sender = Sender::find($id)->get()->first();
        return view('dashboard.layouts.sender.update', compact('sender'));
    }

    public function updateAction(Request $request)
    {

        $id = decrypt($request->id);

        $validated = $request->validate([
            'name' => 'required',
            'sender_id' => 'required|unique:senders,sender_id,' . $id,
            'token' => 'min:0'
        ], [
            'sender_id.unique' => 'Sender already exsists'
        ]);

        $credentials = [
            'name' => $validated["name"],
            'sender_id' => $validated["sender_id"],
            'token' => $validated["token"],

        ];


        $sender = Sender::find($id);
        $sender->update($credentials);

        return redirect()->route('sender.index')->with('message', 'Updated Successfully!');
    }


    public function bdbooks_index()
    {

        $template = Template::where('sender', '=', 2)->get();
        return view('dashboard.layouts.sms.bdbooks', compact('template'));
    }

    public function bdbooks_send(Request $request)
    {




        $validated = $request->validate([
            'numbers' => 'required|min:10',
            'message' => 'required|min:2',

        ]);

        $num = $validated['numbers'];
        $message = $validated['message'];
        $sender = Sender::whereId(2)->get()->first();
    
        //one to many request

        $url = get_option("api_url");
        $api_key = $sender->token;
        $senderid = $sender->sender_id;
        $number = str_replace(" ", "", $num);
        $text = $message;

        $data = [
            "api_key" => $api_key,
            "senderid" => $senderid,
            "number" => $number,
            "message" => $text
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        $status = json_decode($response);

        if ($status->response_code == '202') {

            foreach (explode(",", $num) as $single) {

                $log = new Log();
                $log->phone_number = $single;
                $log->sender_id = $senderid;
                $log->sms = $text;
                $log->sent_by = Auth::user()->id;
                $log->save();
            }


            return back()->with('message', 'Sms has been sent successfully');
        } elseif ($status->response_code == '1007') {

            return back()->with('message', 'Balance Insufficient')->with('type', 'error');
        } else {

            return back()->with('message', 'Internal Error')->with('type', 'error');
        }
    }


    public function sinetek_index()
    {

        $template = Template::where('sender', '=', 3)->get();
        return view('dashboard.layouts.sms.sinetek', compact('template'));
    }

    public function sinetek_send(Request $request)
    {


        $validated = $request->validate([
            'numbers' => 'required|min:10',
            'message' => 'required|min:2',

        ]);

        $num = $validated['numbers'];
        $message = $validated['message'];
     

             $numbers=explode(",",$num);
         foreach($numbers as $number){
            $url  =get_option("api_url2");
            $user =get_option("user_name");
            $pass =get_option("key");
    
            $number=$number;
            $text= $message;

            $data = [
                'username'=>$user,
                'password'=>$pass,
                'number'=>$number,
                'message'=>$text
            ];

            $ch = curl_init(); // Initialize cURL
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $smsresult = curl_exec($ch);
            $p = explode("|",$smsresult);
            $sendstatus = $p[0];

            if($sendstatus =='1101'){

                $log = new Log();
                $log->phone_number = $number;
                $log->sender_id ="Sinetek";
                $log->sms = $text;
                $log->sent_by = Auth::user()->id;
                $log->save();
            }
         }
    

            return back()->with('message', 'Sms has been sent successfully');
    
    }

    public function log(){

        return view('dashboard.layouts.sms.log');

    }

    public function logAjax(Request $request){

        $column = array(
            "id",
            "phone_number",
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

            $log = Log::orderBy($columnName, $columnSortOrder)->skip($row)->take($rowperpage)->get();
            $totalRecords_count = Log::count();
            $totalRecords = $totalDRecords = !empty($totalRecords_count) ? $totalRecords_count : 0;
        } else {
            $log = Log::where('phone_number', 'like', '%' . $searchValue . '%')->orderBy($columnName, $columnSortOrder)->skip($row)->take($rowperpage)->get();
            $totalRecords_count =Log::where('phone_number', 'like', '%' . $searchValue . '%')->count();
            $totalRecords = $totalDRecords = !empty($totalRecords_count) ? $totalRecords_count : 0;
        }

        foreach ($log as $key => $item) {



            $data = [];
           
            $data[] = '<label class="checkboxs"><input type="checkbox" data-value="' . $item->id . '"><span class="checkmarks"></span></label>';
            $data[] = "#".$item->id;
            $data[] = $item->phone_number;
            $data[] = "<span class='badge bg-success'>" . $item->sender_name->name . "</span>";
            $data[] = "<p>" . $item->sms . "</p>";
            $data[] = get_admin_name($item->sent_by);
            $data[] =date("d/m/y g:i:s A",strtotime($item->created_at));
            $data[] = '<div class="d-flex">
            
                        <a href="'.route("log.destroy",encrypt($item->id)).'" class="delete-btn"> 
                          <i class="fas fa-trash text-danger"></i>
                         </a>
                      </div>';

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

    public function log_destroy(Request $request){
        try {
            $id = decrypt($request->id);
            $sender = Log::whereId($id);
            if ($sender) {
                $sender->delete();
                return back()->with('message', 'Deleted Successfully!');
            } else {
                return back()->with('message', 'Error')->with('type', 'error');
            }
        } catch (Exception $e) {

            return back()->with('message', 'Invalid Template')->with('type', 'error');
        }
    }


    public function log_destroyALL(Request $request)
    {

        try {
            $token = base64_decode($request->get("token"));

            $ids = json_decode($token);

            foreach ($ids as $i) {

                Log::whereId($i)->delete();
            }
            return back()->with('message', 'Successfully Deleted.');
        } catch (Exception $e) {

            return back()->with('message', 'Error')->with('type', 'error');
        }
    }

}

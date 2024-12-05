<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Sender;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\Records;
use App\Models\Expenses;
use App\Models\Officer;

function get_title()
{

       return "RMC";
}

function get_role_name($id)
{

       $role = DB::table('roles')->whereId($id)->first();
       return $role->name;
}
function get_role_list()
{

       if (Auth::user()->user_role == 1) {
              $role = DB::table('roles')->get();
              return $role;
       } else {
              $role = DB::table('roles')->whereId(Auth::user()->user_role)->get();
              return $role;
       }
}
function get_admin_name($id)
{

       $admin = DB::table('users')->whereId($id)->first();
       return $admin->name;
}

function get_option($name)
{

       if (!empty($name)) {
              $option = DB::table('options')->where("name", "=", $name)->first();
              if ($option) {
                     return $option->value;
              } else {
                     return '';
              }
       } else {
              return '';
       }
}


function get_permission_name($id)
{

       if (!empty($id)) {
              $permission = DB::table('permissions')->where("id", "=", $id)->first();
              if ($permission) {

                     return $permission->name;
              } else {
                     return 'Unknown';
              }
       } else {
              return 'Null';
       }
}


function total_cost()
{

    $records = Records::sum('cost');
       if ($records) {
          return $records;
       }

       return 0;
}

function record_count_today()
{


       $count = Records::whereDate("created_at", Carbon::today())->count();
       return  $count;
}

function record_count_week()
{


       $count = Records::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
       return  $count;
}

function record_count_month()
{


       $count = Records::whereMonth('created_at', Carbon::now()->month)->count();
       return  $count;
}

function total_expenses()
{


       $count = Expenses::count();
       return  $count;
}
function admin()
{


       $count = User::count();
       return  $count;
}
function officer()
{


       $count = Officer::count();
       return  $count;
}

function get_client_ip()
{
       $ipaddress = '';
       if (getenv('HTTP_CLIENT_IP'))
              $ipaddress = getenv('HTTP_CLIENT_IP');
       else if (getenv('HTTP_X_FORWARDED_FOR'))
              $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
       else if (getenv('HTTP_X_FORWARDED'))
              $ipaddress = getenv('HTTP_X_FORWARDED');
       else if (getenv('HTTP_FORWARDED_FOR'))
              $ipaddress = getenv('HTTP_FORWARDED_FOR');
       else if (getenv('HTTP_FORWARDED'))
              $ipaddress = getenv('HTTP_FORWARDED');
       else if (getenv('REMOTE_ADDR'))
              $ipaddress = getenv('REMOTE_ADDR');
       else
              $ipaddress = 'UNKNOWN';

       return $ipaddress;
}



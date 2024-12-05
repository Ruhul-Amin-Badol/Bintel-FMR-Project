<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

function current_user_can(){
    
    $currentPath= Route::getFacadeRoot()->current()->uri();
    $user_role=Auth::user()->user_role;

    //super
    if($user_role==1){

        return true;
    }

    $role=DB::table('roles')->whereId($user_role)->first();
    $permission=explode(",",$role->permissions);
    foreach($permission as $single){

        $slug=DB::table('permissions')->whereId($single)->first();
        if($slug){

           if( in_array( $currentPath,explode(",",$slug->slug) ) ){
            return true;
            break;
           }

        }
    }


    return false;
 
}

function can_view($url){

    $currentPath=str_replace(env('APP_URL'),"",$url);
    $user_role=Auth::user()->user_role;

    //super
    if($user_role==1){

        return true;
    }

    $role=DB::table('roles')->whereId($user_role)->first();
    $permission=explode(",",$role->permissions);
    foreach($permission as $single){

        $slug=DB::table('permissions')->whereId($single)->first();
        if($slug){

           if( in_array( $currentPath,explode(",",$slug->slug) ) ){
            return true;
            break;
           }

        }
    }


    return false;


}

function taka($amount) {
    $formattedAmount = "৳ " . number_format($amount, 2, '.', ',');
    return $formattedAmount;
}
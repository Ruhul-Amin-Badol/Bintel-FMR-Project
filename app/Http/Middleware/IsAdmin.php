<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

            $rule=get_option('ip_rule');
            if ($rule==1) {

                    $white_list = explode(",", get_option('white_listed_ip'));
                    $ip = get_client_ip();
                    if (!in_array($ip, $white_list)) {
                            abort(403,'Please connect to Royal Network');
                    }

            }
            $maintaince_mode=get_option('maintaince_mode');
            if($maintaince_mode=="ON"){
                if (Auth::user()->user_role!=1 )
                abort(403,"Under maintaince_mode");
            }


       if (Auth::user()->status==1 && Auth::user()->is_admin==1){
                return $next($request);
       }

       else{

           return redirect(route("login"))->with(Auth::logout());
       }

        //abort(403);
    }
}

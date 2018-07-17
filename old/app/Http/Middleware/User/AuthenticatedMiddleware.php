<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CamCyber\IpAddressController as IpAddress;

class AuthenticatedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('cp.auth.login');
            }
        }

        if(Auth::check()){//Check if has logged in.
            $validate_ip = Auth::user()->validate_ip;
            if($validate_ip == 1){
                $ip         = IpAddress::getIP(); 
                if($ip == env('IP_ADDRESS', '255.255.255.255')){ //Check if ip address is valid;
                    return $next($request);
                }else{
                    return redirect()->route('cp.auth.not-allow');
                }
            }else{
               return $next($request);
            }
        }
    }
}

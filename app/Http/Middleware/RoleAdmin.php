<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RoleAdmin
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
        if(Auth::user()==Null){
            return response('Insafficient permission');
        }else if(Auth::user()->permission=='Administrator'){
            return response('Insafficient permission');
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if($role != auth()->user()->role) {
            //abort(403) 
            return $request->route()->getActionName() == "App\Http\Controllers\Admin\DashboardController@index" ? redirect()->route('v_dashboard') : abort(403) ;

        }
        return $next($request);
    }
}

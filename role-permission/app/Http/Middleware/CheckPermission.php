<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\RolePermission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission_name)
    {
        $permission = Permission::where('route', $permission_name)->first();
        if($permission) {
            $role_id = Auth::user()->role_id;
            $check_permission = RolePermission::where('role_id', $role_id)->where('permission_id', $permission->id)->first();
            //dd($check_permission);
            if($check_permission != null){
            } else {
                return redirect('home');
            }
            return $next($request);
        } else {
            return redirect('home');
        }
    }
}

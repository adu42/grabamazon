<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Middleware\UserRole;
use Auth;

class UserAdmin extends UserRole
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
        if (!Auth::check()){
            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            }
            else
            {
                return redirect()->guest('login');
            }
        }else{
            $role = $this->check_admin();
            if(!$role)return abort(403);
        }
        return $next($request);
    }
}

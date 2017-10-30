<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Vmenu;
use Session;
use App\Http\Middleware\UserRole;

class NotNeedUser extends UserRole
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
        if (Auth::check()){
            $this->check_not_user();
        }
        return $next($request);
    }

    protected function check_not_user(){
        $menus = $this->getUserMenu();
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckAdminUser
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
        if (Auth::check() && Auth::user()->user_rights == 0) {
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->user_rights == 1) {
            return redirect()->route('getIndexPage');
        }
        else{
            return redirect()->route('getLogin')->with(['messages' => 'Bạn phải đăng nhập để tiếp tục','level' => 'danger']);
        }
    }
}

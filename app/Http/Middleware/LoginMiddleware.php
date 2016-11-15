<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class LoginMiddleware
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
        if( !Auth::check() ){
            \Request::session()->put('url', [
                "intended" => url(\Request::server("REQUEST_URI"))
            ]);
            return redirect()->to(url("/". config("app.version") ."login"));
        }
        return $next($request);
    }
}

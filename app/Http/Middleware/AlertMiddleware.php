<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AlertMiddleware
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
        $ret = $next($request);

        if (!$request->isMethod('GET')) {
            if ($message = session('success')) {
                Alert::toast($message, 'success');
            }

            if ($message = session('error')) {
                Alert::toast($message, 'error');
            }

            if ($message = session('warning')) {
                Alert::toast($message, 'warning');
            }
        }

        return $ret;
    }
}

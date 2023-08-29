<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class pageuser
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
        if(Auth::check() && ( Auth::user()->tipe_user_id == 'ADM'         // Admin
                              OR Auth::user()->tipe_user_id == 'ABA'      // Abaper
                              OR Auth::user()->tipe_user_id == 'FUN'      // Functional
                              OR Auth::user()->tipe_user_id == 'BAS'      // Basis
                              OR Auth::user()->tipe_user_id == 'USE'      // User
                              )) {
            return $next($request);
          }
        // return redirect ('dashboard')->with('error_pagerole','You are not authorize for this page!');
        return back()->with('error_pagerole','Anda tidak dizinkan untuk membuka halaman tersebut...!');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class PageRoles
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
      if(Auth::check() && Auth::user()->tipe_user_id == '1') { // Hanya admin yang bisa mengakses master data
        return $next($request);
      }
      // return redirect ('dashboard')->with('error_pagerole','You are not authorize for this page!');
      // return redirect('dashboard')->with('','Modul Has Been updated successfully');
        return back()->with('error_pagerole','Anda tidak dizinkan untuk membuka halaman tersebut!');
    }
}

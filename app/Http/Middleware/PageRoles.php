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
      if(Auth::check() && Auth::user()->tipe_user_id == '1') {
        return $next($request);
      }
      return redirect ('dashboard')->with('error_pagerole','You are not authorize for this page!');
      // return redirect('dashboard')->with('','Modul Has Been updated successfully');
        // return back()->with('e1','You are not authorize for this page');
    }
}

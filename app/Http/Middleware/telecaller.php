<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class telecaller
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
        if(auth()->user()->telecaller == 1){
            return $next($request);
        }
   
        return redirect()->back()->with('message',"You are not a telecaller.");
    }
}

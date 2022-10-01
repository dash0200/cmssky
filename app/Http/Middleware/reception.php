<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class reception
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
        $session = Auth::user();

        if($session !== null){
            if(isset($session['id']) && $session['user_type'] == 'reception') {
                return $next($request);
            } else {
                return redirect()->route('dashboard');
            }

        } else {
            return redirect()->route('login');
        }
    }
}

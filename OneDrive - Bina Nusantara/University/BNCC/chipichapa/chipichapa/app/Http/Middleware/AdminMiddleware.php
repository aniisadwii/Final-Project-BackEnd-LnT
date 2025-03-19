<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminMiddleware
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
        if(Auth::check()){
            if(Auth::user()->role !== 'admin'){
                return redirect('/view-books');
            }
        }
        else{
            return redirect('/register');
        }
        return $next($request);
        
        // if (!Auth::check()) {
        //     return redirect('/login'); // Jika tidak login, ke login
        // }
    
        // if (Auth::user()->role !== 'admin') {
        //     abort(403, 'Unauthorized action.'); // Jika bukan admin, tampilkan error 403
        // }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PairMiddleware
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
        $value = $request->input('value');
        $result = $value % 2  == 0;
        if ($request->has('value')){
            if( $result) {
                return redirect('/pair');
            } else {
                return redirect('/impair');
            }
        }

        return $next($request);
    }
}

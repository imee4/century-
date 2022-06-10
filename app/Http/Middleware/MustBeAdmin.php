<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Log;

class MustBeAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //Log::info(auth()->user()->user_type_id);
        if(!(auth()->user()?->user_type_id == 1))
        {
            abort(304);

        }
        return $next($request);
    }
}

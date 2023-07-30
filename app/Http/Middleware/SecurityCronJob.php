<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityCronJob
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $get_key = $request->input('key_secret', '');

        if ($get_key == env('KEY_SECRET_CRONJOB')) {
            return $next($request);
        }

        return redirect('/');
    }
}

<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Log;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

	// public function handle(Request $request, Closure $next)
	// {
//		 Log::info($request);
//
//		 return $next($request);
//	 }


    protected function redirectTo($request)
    {
	      Log::info($request);
    	// ถ้าเป็น API ขอให้ตอบ JSON แทน redirect
	    if ($request->expectsJson()) {
		    Log::info('Redirecting unauthenticated api user to login route.');
            abort(response()->json(['error' => 'Unauthorized'], 401));
        }

        return route('login'); // สำหรับ web redirect ปกติ
    }
}

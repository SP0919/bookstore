<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckTokenExpiry
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
        // die("  dcd");
        $errorMessages = ['error' => "Please Login First."];
        if (Auth::guard('api')->check()) {
            if (!empty(auth('api')->user()->email_verified_at)) {
                return $next($request);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Please verify email address to continue.",
                ];




                return response()->json($response);
            }
        } else {
            $response = [
                'success' => false,
                'message' => "Unauthorised",
            ];


            if (!empty($errorMessages)) {
                $response['data'] = $errorMessages;
            }
            return response()->json($response);
        }
    }
}

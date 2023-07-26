<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {

        $errorMessages = ['error' => "Please Login First."];
        if (Auth::guard('api')->check()) {
            if (in_array(auth('api')->user()->user_type, $roles)) {
                return $next($request);
            } else {
                $response = [
                    'success' => false,
                    'message' => "You are not allowed for this url.",
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

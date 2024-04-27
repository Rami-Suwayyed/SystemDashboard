<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\Facades\URL;


class CheckGeneralToken
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


        if ($request->header('Token') != '82264d6f3bb45e2ede9cb83e7b9e650de9a6a623') {
            $response = [
                'status' => 0,
                'message' => 'Unauthorized',
                'data' => false
            ];

            return response()->json($response, 413);
        } //else {

        app()->setLocale($request->header('Language'));

            /*if ($request->user('api')) {
                if ($request->user('api')->country()->first()) {
                    $time_area = $request->user('api')->country()->first()->time_area;
                    if ($time_area) {
                        date_default_timezone_set($time_area);
                    }
                }
            }*/

            return $next($request);
      //  }
    }
}

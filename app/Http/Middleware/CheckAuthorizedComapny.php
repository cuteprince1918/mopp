<?php

namespace App\Http\Middleware;

use Session;
use Closure;

class CheckAuthorizedComapny
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Session::has('USERTYPE') && !Session::get('USERTYPE') == '3') {
//            $statusCode = '401';
//            $statusMsg = 'Unauthorized';
//            $data["data"]["message"] = '401 Unauthorized Error';
//            $data["data"]["statusCode"] = $statusCode;
//            $data["data"]["statusMsg"] = $statusMsg;
            return Redirect::to('/');
        }

        return $response = $next($request);
    }
}

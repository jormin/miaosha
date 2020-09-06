<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class BuyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // todo 预留过滤：请求来源检测、IP检测及限制、用户鉴权等等
        return $next($request);
    }
}

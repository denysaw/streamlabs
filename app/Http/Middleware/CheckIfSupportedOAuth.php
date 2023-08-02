<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfSupportedOAuth
{

    public const SUPPORTED_PROVIDERS = ['facebook', 'google'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!in_array($request->route('provider'), self::SUPPORTED_PROVIDERS)) {
            return response()->json(['message' => 'Unsupported OAuth provider'], 406);
        }

        return $next($request);
    }
}

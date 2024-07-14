<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ApiKey;

class CheckApiKey
{
    public function handle($request, Closure $next)
    {
        $apiKey = $request->header('x-api-key');

        if (!$apiKey || !($apiKeyRecord = ApiKey::where('key', $apiKey)->first())) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $request->merge(['user' => $apiKeyRecord->user]);

        return $next($request);
    }
}

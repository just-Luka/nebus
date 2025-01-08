<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class InternalAPI
{
    /**
     * @param string $apiKey
     */
    public function __construct(
        private string $apiKey
    ) {}

    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->apiKey !== $request->header('X-API-Key')) {
            return \response()->json(['error' => 'Invalid API key.'], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}

<?php


namespace App\Http\Middleware;


use App\Exceptions\Auth\ApiAuthenticationException;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class JwtAuthCheck extends Middleware
{
    private $except = [];

    public function handle($request, Closure $next, ...$guards)
    {
        if ($request->is(...$this->except)) {
            return $next($request);
        }
        try {
            $this->checkForToken($request);
            if ($this->auth->parseToken()->authenticate()) {
                return $next($request);
            }
            throw new ApiAuthenticationException('unAuthentication');
        } catch (\Exception $exception) {
            if ($exception instanceof TokenExpiredException) {
                try {
                    $token = $this->auth->refresh();
                    return response()->json(B::makeTokenData($token))->setStatusCode(203);
                } catch (\Exception $exception) {
                    throw new ApiAuthenticationException('unAuthentication');
                }
            } else {
                throw new ApiAuthenticationException('unAuthentication');
            }
        }
    }
}

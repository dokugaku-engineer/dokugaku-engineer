<?php

namespace App\Http\Middleware;

use Closure;
use Auth0\SDK\JWTVerifier;
use App\Traits\JsonRespondController;

/**
 * Machine to machine用のアクセストークンを検証する
 * clientをbuildする際のトークン付きアクセスの検証に用いる
 */
class CheckM2MJWT
{
    use JsonRespondController;

    /**
     * JWTアクセストークンを検証する
     *
     * @param  \Illuminate\Http\Request  $request - Illuminate HTTP Request object.
     * @param  \Closure  $next - Function to call when middleware is complete.
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $scopeRequired = null)
    {
        info(1);

        $accessToken = $request->bearerToken();
        if (empty($accessToken)) {
            return $this->respondUnauthorized('Bearer token missing');
        }

        info(print_r($accessToken, true));

        info(2);
        $laravelConfig = config('laravel-auth0');
        $jwtConfig = [
            'authorized_iss' => $laravelConfig['authorized_issuers'],
            'valid_audiences' => [$laravelConfig['management_api_api_identifier']],
            'supported_algs' => $laravelConfig['supported_algs'],
        ];

        info(print_r($jwtConfig, true));

        try {
            info(3);
            $jwtVerifier = new JWTVerifier($jwtConfig);
            info(4);
            info(print_r($jwtVerifier, true));
            $decodedToken = $jwtVerifier->verifyAndDecode($accessToken);
            info(5);
        } catch (\Exception $e) {
            info(6);
            return $this->respondUnauthorized($e->getMessage());
        }

        return $next($request);
    }
}

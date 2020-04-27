<?php

namespace App\Http\Middleware;

use Closure;
use Auth0\SDK\JWTVerifier;
use App\Traits\JsonRespondController;

class CheckJWT
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

        $accessToken = $request->bearerToken();
        if (empty($accessToken)) {
            return $this->respondUnauthorized('Bearer token missing');
        }

        $laravelConfig = config('laravel-auth0');
        $jwtConfig = [
            'authorized_iss' => $laravelConfig['authorized_issuers'],
            'valid_audiences' => [$laravelConfig['api_identifier']],
            'supported_algs' => $laravelConfig['supported_algs'],
        ];

        try {
            $jwtVerifier = new JWTVerifier($jwtConfig);
            $auth0Cache = app()->make('\Auth0\SDK\Helpers\Cache\CacheHandler');
            $decodedToken = $auth0Cache->get($accessToken);
            if (!isset($decodedToken)) {
                $decodedToken = $jwtVerifier->verifyAndDecode($accessToken);
                $auth0Cache->set($accessToken, $decodedToken);
            }
        } catch (\Exception $e) {
            return $this->respondUnauthorized($e->getMessage());
        }

        if ($scopeRequired && !$this->tokenHasScope($decodedToken, $scopeRequired)) {
            return $this->respondInsufficientScope('Insufficient scope');
        }

        $USERID_NAMESPACE = env('AUTH0_NAMESPACE') . 'user_id';
        $request->merge([
            'user_id' => $decodedToken->$USERID_NAMESPACE,
            'auth0_user_id' => $decodedToken->sub
        ]);
        return $next($request);
    }

    /**
     * トークンにスコープが設定されている場合はチェックする
     *
     * @param \stdClass $token - JWT access token to check.
     * @param string $scopeRequired - Scope to check for.
     *
     * @return bool
     */
    protected function tokenHasScope($token, $scopeRequired)
    {
        if (empty($token->scope)) {
            return false;
        }

        $tokenScopes = explode(' ', $token->scope);
        return in_array($scopeRequired, $tokenScopes);
    }
}

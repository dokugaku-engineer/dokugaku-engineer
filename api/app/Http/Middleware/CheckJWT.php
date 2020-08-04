<?php

namespace App\Http\Middleware;

use App\Traits\JsonRespondController;
use Auth0\SDK\JWTVerifier;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CheckJWT
{
    use JsonRespondController;

    // キャッシュの有効期限。Auth0のIDトークンの有効期限と合わせる
    private const EXPIRE_SECONDS = 36000;

    /**
     * JWTアクセストークンを検証する
     *
     * @param \Illuminate\Http\Request $request       - Illuminate HTTP Request object.
     * @param \Closure                 $next          - Function to call when middleware is complete.
     * @param string                   $scopeRequired - Scope to check for.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $scopeRequired = null)
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
            $decodedToken = Cache::remember($accessToken, self::EXPIRE_SECONDS, function () use ($jwtVerifier, $accessToken) {
                return $jwtVerifier->verifyAndDecode($accessToken);
            });
        } catch (\Exception $e) {
            return $this->respondUnauthorized($e->getMessage());
        }

        if ($scopeRequired && !$this->tokenHasScope($decodedToken, $scopeRequired)) {
            return $this->respondInsufficientScope('Insufficient scope');
        }

        $USERID_NAMESPACE = env('AUTH0_NAMESPACE') . 'user_id';
        $request->merge([
            'user_id' => $decodedToken->$USERID_NAMESPACE,
            'auth0_user_id' => $decodedToken->sub,
        ]);

        return $next($request);
    }

    /**
     * トークンにスコープが設定されている場合はチェックする
     *
     * @param \stdClass $token         - JWT access token to check.
     * @param string    $scopeRequired - Scope to check for.
     *
     * @return bool
     */
    protected function tokenHasScope($token, string $scopeRequired)
    {
        if (empty($token->scope)) {
            return false;
        }

        $tokenScopes = explode(' ', $token->scope);

        return in_array($scopeRequired, $tokenScopes);
    }
}

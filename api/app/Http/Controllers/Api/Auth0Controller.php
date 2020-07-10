<?php

namespace App\Http\Controllers\Api;

use App\Services\Auth0Service;
use Illuminate\Http\Request;

/**
 * @group 4. Auth0
 */
class Auth0Controller extends ApiController
{
    /**
     * 認証用メールを送信
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendVerificationEmail(Request $request)
    {
        $userId = $request->input('user_id');
        $auth0Client = new Auth0Service();
        $response = $auth0Client->sendVerificationEmail(json_encode(['user_id' => $userId]));
        $statusCode = array_key_exists('statusCode', $response) ? (int) $response['statusCode'] : 201;

        return $this->setHTTPStatusCode($statusCode)->respond($response);
    }
}

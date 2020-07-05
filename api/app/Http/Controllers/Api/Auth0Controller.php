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
        $user_id = $request->input('user_id');
        $auth0_client = new Auth0Service();
        $response = $auth0_client->sendVerificationEmail(json_encode(['user_id' => $user_id]));
        $statusCode = array_key_exists('statusCode', $response) ? (int) $response['statusCode'] : 201;

        return $this->setHTTPStatusCode($statusCode)->respond($response);
    }
}

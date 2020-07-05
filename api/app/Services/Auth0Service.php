<?php

namespace App\Services;

use Log;

class Auth0Service
{
    /**
     * 複数代入しない属性
     *
     * @var string
     */
    protected $access_token = '';

    public function __construct()
    {
        $this->access_token = $this->getAccessToken();
    }

    /**
     * ユーザー情報を更新する
     *
     * @param string $user_id Auth0のユーザーID
     * @param string $data    JSON形式の文字列
     *
     * @return string
     */
    public function updateUser(string $user_id, string $data): string
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://'.env('AUTH0_DOMAIN').'/api/v2/users/'.$user_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PATCH',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer {$this->access_token}",
                'content-type: application/json',
            ],
        ]);
        $auth0_user = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            Log::error('auth0 update a user error #:'.$err);
        }

        return $auth0_user;
    }

    /**
     * ユーザーを削除する
     *
     * @param string $user_id Auth0のユーザーID
     *
     * @return bool|string
     */
    public function deleteUser(string $user_id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://'.env('AUTH0_DOMAIN').'/api/v2/users/'.$user_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer {$this->access_token}",
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            Log::error('auth0 delete a user error #:'.$err);
        }

        return $response;
    }

    /**
     * 認証用メールを送信する
     *
     * @param string $data JSON形式の文字列
     *
     * @return array
     */
    public function sendVerificationEmail(string $data): array
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://'.env('AUTH0_DOMAIN').'/api/v2/jobs/verification-email',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer {$this->access_token}",
                'content-type: application/json',
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            Log::error('auth0 send a verification email error #:'.$err);
        }

        return json_decode($response, true);
    }

    /**
     * アクセストークンを取得する
     *
     * @return string
     */
    private function getAccessToken(): string
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://'.env('AUTH0_DOMAIN').'/oauth/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials&client_id='.env('AUTH0_MANAGEMENT_API_CLIENT_ID').'&client_secret='.env('AUTH0_MANAGEMENT_API_CLIENT_SECRET').'&audience='.env('AUTH0_MANAGEMENT_API_AUDIENCE'),
            CURLOPT_HTTPHEADER => [
                'content-type: application/x-www-form-urlencoded',
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $access_token = '';
        if ($err) {
            Log::error('auth0 get access token error #:'.$err);
        } else {
            $access_token = json_decode($response, true)['access_token'];
        }

        return $access_token;
    }
}

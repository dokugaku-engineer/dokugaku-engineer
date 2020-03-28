<?php

namespace App\Services;

use Log;

class Auth0Service
{
    public function __construct()
    {
        $this->access_token = $this->getAccessToken();
    }

    /**
     * ユーザー情報を更新する
     *
     * @param string $user_id Auth0のユーザーID
     * @param string $data JSON形式の文字列
     *
     * @return string
     *
     */
    public function updateUser($user_id, $data)
    {
        info(22);
        info($this->access_token);
        info(env('AUTH0_DOMAIN'));

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://" . env('AUTH0_DOMAIN') . "/api/v2/users/" . $user_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PATCH",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer {$this->access_token}",
                "content-type: application/json"
            ),
        ));
        $auth0_user = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            info(23);
            Log::error("auth0 update a user error #:" . $err);
        }

        return $auth0_user;
    }

    /**
     * 認証用メールを送信する
     *
     * @param string $data JSON形式の文字列
     *
     * @return array
     *
     */
    public function sendVerificationEmail($data)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://" . env('AUTH0_DOMAIN') . "/api/v2/jobs/verification-email",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer {$this->access_token}",
                "content-type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            Log::error("auth0 send a verification email error #:" . $err);
        }

        return json_decode($response, true);
    }

    /**
     * アクセストークンを取得する
     *
     * @return string
     *
     */
    private function getAccessToken()
    {
        info(20);
        info(env('AUTH0_MANAGEMENT_API_CLIENT_ID'));
        info(env('AUTH0_MANAGEMENT_API_CLIENT_SECRET'));
        info(env('AUTH0_MANAGEMENT_API_AUDIENCE'));

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://" . env('AUTH0_DOMAIN') . "/oauth/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=client_credentials&client_id=" . env('AUTH0_MANAGEMENT_API_CLIENT_ID') . "&client_secret=" . env('AUTH0_MANAGEMENT_API_CLIENT_SECRET') . "&audience=" . env('AUTH0_MANAGEMENT_API_AUDIENCE'),
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $access_token = '';
        curl_close($curl);
        if ($err) {
            Log::error("auth0 get access token error #:" . $err);
        } else {
            $access_token = json_decode($response, true)['access_token'];
            info(21);
            info(json_decode($response, true));
        }

        return $access_token;
    }
}

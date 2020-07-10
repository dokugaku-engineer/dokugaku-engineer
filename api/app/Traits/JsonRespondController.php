<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait JsonRespondController
{
    /**
     * @var int
     */
    protected $httpStatusCode = 200;

    /**
     * @var int
     */
    protected $errorCode;

    /**
     * レスポンスのHTTPステータスコードを送信
     *
     * @return int
     */
    public function getHTTPStatusCode(): int
    {
        return $this->httpStatusCode;
    }

    /**
     * レスポンスのHTTPステータスコードを設定
     *
     * @param int $statusCode
     * @return self
     */
    public function setHTTPStatusCode(int $statusCode): self
    {
        $this->httpStatusCode = $statusCode;

        return $this;
    }

    /**
     * レスポンスのエラーコードを送信
     *
     * @return int
     */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    /**
     * レスポンスのエラーコードを設定
     *
     * @param int $errorCode
     * @return self
     */
    public function setErrorCode(int $errorCode): self
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    /**
     * 無効なクエリに対してエラーを送信
     * Error Code = 40
     *
     * @param string $message
     * @return JsonResponse
     */
    public function respondInvalidQuery(?string $message = null): JsonResponse
    {
        return $this->setHTTPStatusCode(500)
            ->setErrorCode(40)
            ->respondWithError($message);
    }

    /**
     * 不適切な認証に対してエラーを送信
     * Error Code = 31
     *
     * @param string $message
     * @return JsonResponse
     */
    public function respondUnauthorized(?string $message = null): JsonResponse
    {
        return $this->setHTTPStatusCode(401)
            ->setErrorCode(31)
            ->respondWithError($message);
    }

    /**
     * 権限不足に対してエラーを送信
     * Error Code = 32
     *
     * @param string $message
     * @return JsonResponse
     */
    public function respondInsufficientScope(?string $message = null): JsonResponse
    {
        return $this->setHTTPStatusCode(403)
            ->setErrorCode(32)
            ->respondWithError($message);
    }

    /**
     * 対象が見つからないためエラーを送信
     * Error Code = 33
     *
     * @param string $message
     * @return JsonResponse
     */
    public function respondNotFound(?string $message = null): JsonResponse
    {
        return $this->setHTTPStatusCode(404)
            ->setErrorCode(33)
            ->respondWithError($message);
    }

    /**
     * エラー時にレスポンスを送信
     *
     * @param string $message
     * @return JsonResponse
     */
    public function respondWithError(?string $message = null): JsonResponse
    {
        return $this->respond([
            'error' => [
                'message' => $message ?? config('api.error_codes.'.$this->getErrorCode()),
                'code' => $this->getErrorCode(),
            ],
        ]);
    }

    /**
     * JSONを送信
     *
     * @param array $data
     * @return JsonResponse
     */
    public function respondWithOK(array $data)
    {
        return $this->setHTTPStatusCode(200)
            ->respond($data);
    }

    /**
     * JSONを送信
     *
     * @param array $data
     * @param array $headers
     * @return JsonResponse
     */
    public function respond(array $data, array $headers = []): JsonResponse
    {
        return response()->json($data, $this->getHTTPStatusCode(), $headers);
    }
}

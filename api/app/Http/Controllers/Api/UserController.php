<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\UserRequest;
use App\Http\Resources\User\User as UserResource;
use App\Models\User;
use Illuminate\Database\QueryException;
use App\Services\Auth0Service;

/**
 * @group 5. User
 */
class UserController extends ApiController
{
    /**
     * ユーザーを保存
     *
     * @bodyParam users[username] string required User username. Example: kiyodori
     *
     * @responsefile responses/user.store.json
     *
     * @param UserRequest $request
     * @return PostResource|\Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request)
    {
        $auth0_user_id = $request->input('auth0Userid');
        try {
            $validated = $request->validated();
            $user = new User($validated);
            $user->save();

            // 本来はClient側でAuth0ユーザーの情報を更新する処理を行いたかったが、SPA上ではCORS preflight requestエラーになったため、APIで実行
            $auth0_client = new Auth0Service();
            $auth0_client->updateUser($auth0_user_id, json_encode(['user_metadata' => ['id' => $user->id]]));
        } catch (QueryException $e) {
            return $this->respondInvalidQuery($e);
        }

        return new UserResource($user);
    }
}

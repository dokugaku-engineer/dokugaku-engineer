<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use App\Http\Resources\User\User as UserResource;
use App\Models\User;
use App\Services\Auth0Service;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

/**
 * @group 3. Users
 */
class UserController extends ApiController
{
    /**
     * ユーザーを保存
     *
     * @bodyParam users[username] string required User username. Example: kiyodori
     * @bodyParam users[email] string required User email. Example: sample@example.com
     *
     * @responsefile responses/user.store.json
     *
     * @param UserRequest $request
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request)
    {
        $auth0UserId = $request->input('auth0Userid');
        try {
            $validated = $request->validated();
            $user = new User($validated);
            $user->save();

            // 本来はClient側でAuth0ユーザーの情報を更新する処理を行いたかったが、SPA上ではCORS preflight requestエラーになったため、APIで実行
            $auth0Client = new Auth0Service();
            $auth0Client->updateUser($auth0UserId, json_encode(['user_metadata' => ['id' => $user->id]]));
        } catch (QueryException $e) {
            return $this->respondInvalidQuery($e);
        }

        return new UserResource($user);
    }

    /**
     * ユーザーを取得
     *
     * @responsefile responses/user.store.json
     *
     * @param UserRequest $request
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function show(Request $request, User $user)
    {
        if ($request['user_id'] !== $user->id) {
            return $this->respondInvalidQuery('Invalid user');
        }

        return new UserResource($user);
    }

    /**
     * ユーザーを更新
     *
     * @bodyParam users[username] string required User username. Example: kiyodori
     * @bodyParam users[email] string required User email. Example: sample@example.com
     *
     * @responsefile responses/user.store.json
     *
     * @param UserRequest $request
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, User $user)
    {
        if ($request['user_id'] !== $user->id) {
            return $this->respondInvalidQuery('Invalid user');
        }

        $oldEmail = $user->email;
        try {
            $validated = $request->validated();
            $user->fill($validated);
            $user->save();

            // メールアドレスが変更された時、Auth0のメールアドレスを更新
            if ($user->email !== $oldEmail) {
                $auth0Client = new Auth0Service();
                $auth0Client->updateUser($request['auth0_user_id'], json_encode([
                    'email' => $user->email,
                    'email_verified' => true,
                ]));
            }
        } catch (QueryException $e) {
            return $this->respondInvalidQuery($e);
        }

        return new UserResource($user);
    }

    /**
     * ユーザーを削除
     *
     * @responsefile responses/user.store.json
     *
     * @param UserRequest $request
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, User $user)
    {
        if ($request['user_id'] !== $user->id) {
            return $this->respondInvalidQuery('Invalid user');
        }

        $auth0UserId = $request->input('auth0_user_id');

        try {
            $user->delete();
            // Auth0のユーザーを削除
            $auth0Client = new Auth0Service();
            $auth0Client->deleteUser($auth0UserId);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery($e);
        }

        return new UserResource($user);
    }
}

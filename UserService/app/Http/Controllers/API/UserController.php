<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(protected UserService $userService){}

    /**
     * Store user and send message
     * @param \App\Http\Requests\User\UserStoreRequest $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function __invoke(UserStoreRequest $request)
    {
        return response()->json($this->userService->saveUser($request), Response::HTTP_CREATED);
    }
}

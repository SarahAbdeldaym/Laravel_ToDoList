<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\SignupUserRequest;
use App\Services\UserService;

class UserController extends Controller {

    public function __construct(private UserService $userService) {}

    public function signup(SignupUserRequest $request) {
        $user = $this->userService->signup(
            $request->input('name'),
            $request->input('email'),
            $request->input('password')
        );

        return response()->json([
            'status' => true,
            'data' => $user
        ]);
    }

    public function login(LoginUserRequest $request) {
        $token = $this->userService->login(
            $request->input('email'),
            $request->input('password')
        );

        return response()->json([
            'status' => true,
            'data' => $token
        ]);
    }

}

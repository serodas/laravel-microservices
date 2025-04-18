<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    private UserService $userService;
    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->only('first_name', 'last_name', 'email', 'password') + ['is_admin' => 0];

        $user = $this->userService->post("register", $data);
        return response($user, Response::HTTP_CREATED);
    }
}

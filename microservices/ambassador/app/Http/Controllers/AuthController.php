<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function __construct(private UserService $userService) {}

    public function register(RegisterRequest $request)
    {
        $data = $request->only('first_name', 'last_name', 'email', 'password') + ['is_admin' => 0];

        $user = $this->userService->post("register", $data);
        return response($user, Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $data = $request->only('email', 'password') + ['scope' => 'ambassador'];

        $response = $this->userService->post("login", $data);

        $cookie = cookie('jwt', $response['jwt'], 60 * 24);

        return response([
            'message' => 'success'
        ])->withCookie($cookie);
    }
}

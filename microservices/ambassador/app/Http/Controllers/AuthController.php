<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Order;
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

    public function user(Request $request)
    {
        $user = $this->userService->get('user');

        $orders = Order::where('user_id', $user['id'])->get();

        $user['revenue'] = $orders->sum(fn(Order $order) => $order->total);

        return $user;
    }

    public function logout()
    {
        $cookie = \Cookie::forget('jwt');
        $this->userService->post('logout', []);

        return response([
            'message' => 'success'
        ])->withCookie($cookie);
    }

    public function updateInfo(UpdateInfoRequest $request)
    {
        $user = $this->userService->put(
            'users/info',
            $request->only('first_name', 'last_name', 'email')
        );

        return response($user, Response::HTTP_ACCEPTED);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = $this->userService->put('users/info', $request->only('password'));

        return response($user, Response::HTTP_ACCEPTED);
    }
}

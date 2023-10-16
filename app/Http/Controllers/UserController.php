<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    //  use AuthorizesRequests, ValidatesRequests;

    private $userRepository;


    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function register(UserRegisterRequest $request)

    {
        $registrationData = [
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => $request['password'],
            'role' => $request['role'],
        ];
        $user = $this->userRepository->create($registrationData);
        return response()->json(
            $user,
        );
    }
    public function login(UserLoginRequest $request)

    {
        $loginData = [
            'email' => $request['email'],
            'password' => $request['password'],
            'role' => $request['role'],
        ];
        $user = $this->userRepository->login($loginData);
        return response()->json([
            $user,
        ]);
    }
    public function logout(Request $request)
    {
        $user = $this->userRepository->logout($request);
        return response()->json(
            $user,
        );
    }
}

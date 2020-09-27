<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function register(RegisterRequest $request){
        $request->validated();

        $user = $this->userRepository->create(['name' => $request->name,'email' => $request->email,'password' => Hash::make($request->password),]);
        return $user->createToken($request->device_name)->plainTextToken;

    }
}

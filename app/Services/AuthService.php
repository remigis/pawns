<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\WalletRepository;
use Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function registerNewUser(array $data): User
    {
        $userRepository = resolve(UserRepository::class);
        $walletRepository = resolve(WalletRepository::class);

        $proxyCheckService = new ProxyCheckService(request()->ip());
        if($proxyCheckService->getProxy() == 'yes'){
            throw ValidationException::withMessages(["You can't use proxy to register"]);
        }

        $user = $userRepository->createUser($data);
        $walletRepository->createUsersWallet($user);
        $userRepository->updateUser($user->id, ['country' => $proxyCheckService->getCountry()]);

        return $user;
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function loginUser(array $credentials): string
    {
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $user = Auth::user();

        return $user->createToken('auth_token')->plainTextToken;
    }
}

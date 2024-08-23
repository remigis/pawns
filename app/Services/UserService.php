<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setUsersCountryByIP(User $user, string $ip): void
    {
        $userRepository = resolve(UserRepository::class);
        $proxyCheckService = new ProxyCheckService($ip);
        $userRepository->updateUser($user->id, ['country' => $proxyCheckService->getCountry()]);
    }
}

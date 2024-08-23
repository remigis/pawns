<?php

namespace App\Interfaces;

use App\Models\ProfileInfo;
use App\Models\User;
use Illuminate\Support\Collection;

interface ProfileInfoRepositoryInterface
{
    public function getUsersProfileInfos(User $user):Collection;

    public function getUsersProfileInfo(User $user, string $key):?ProfileInfo;

    public function setProfileInfo(User $user, string $key, string $value):void;

    public function deleteProfileInfo(User $user, string $key):void;
}

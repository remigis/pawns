<?php

namespace App\Repositories;

use App\Interfaces\ProfileInfoRepositoryInterface;
use App\Models\ProfileInfo;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ProfileInfoRepository implements ProfileInfoRepositoryInterface
{

    public const PROFILE_INFO_KEY_GENDER = 'gender';
    public const PROFILE_INFO_KEY_DATE_OF_BIRTH = 'date_of_birth';
    public const PROFILE_INFO_KEY_UPDATED_AT = 'updated_at';

    public function getUsersProfileInfos(User $user): Collection|\Illuminate\Support\Collection
    {
        return ProfileInfo::where('user_id', $user->id)->get();
    }

    public function getUsersProfileInfo(User $user, string $key):?ProfileInfo
    {
        return ProfileInfo::where('user_id', $user->id)->where('key', $key)->first();
    }

    public function setProfileInfo(User $user, string $key, mixed $value): void
    {
        ProfileInfo::updateOrCreate(['user_id' => $user->id, 'key' => $key], ['value' => $value]);
    }

    public function deleteProfileInfo(User $user, string $key): void
    {
        ProfileInfo::where('user_id', $user->id)->where('key', $key)->delete();
    }

}

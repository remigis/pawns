<?php

namespace App\Rules;

use App\Models\ProfileInfo;
use App\Repositories\ProfileInfoRepository;
use App\Repositories\ProfilingQuestionRepository;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ProfileCanBeUpdatedOnceADay implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $profileInfoRepository = resolve(ProfileInfoRepository::class);
        $updatedAt = $profileInfoRepository->getUsersProfileInfo(Auth::user(), ProfileInfoRepository::PROFILE_INFO_KEY_UPDATED_AT);

        if($updatedAt && $updatedAt->value === Carbon::now()->toDateString()){
            $fail("Can not update profile more then one time per day");
        }
    }
}

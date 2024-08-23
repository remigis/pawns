<?php

namespace App\Services;

use App\Repositories\ProfileInfoRepository;
use App\Repositories\ProfilingQuestionRepository;
use Auth;
use Illuminate\Support\Carbon;

class ProfileInfoService
{

    public function updateProfileFromAnswers(array $answers): void
    {
        $profileInfoRepository = resolve(ProfileInfoRepository::class);
        $profilingQuestionRepository = resolve(ProfilingQuestionRepository::class);

        foreach ($answers as $answer) {
            $question = $profilingQuestionRepository->getProfilingQuestionById($answer['questionId']);
            $profileInfoRepository->setProfileInfo(Auth::user(), $question->profile_info_key, $answer['answer']);
        }
        $profileInfoRepository->setProfileInfo(
            Auth::user(),
            ProfileInfoRepository::PROFILE_INFO_KEY_UPDATED_AT,
            Carbon::now()->toDateString()
        );
    }

}

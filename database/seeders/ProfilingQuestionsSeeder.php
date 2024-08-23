<?php

namespace Database\Seeders;

use App\Models\ProfilingQuestion;
use App\Repositories\ProfileInfoRepository;
use App\Repositories\ProfilingQuestionRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilingQuestionsSeeder extends Seeder
{

    /**
     * @var \App\Repositories\ProfilingQuestionRepository|\Illuminate\Foundation\Application|mixed
     */
    private $profilingQuestionRepository;

    public function __construct()
    {
        $this->profilingQuestionRepository = resolve(ProfilingQuestionRepository::class);
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->profilingQuestionRepository->createProfilingQuestion([
            'text' => 'What is your gender?',
            'type' => ProfilingQuestionRepository::QUESTION_TYPE_SINGLE_CHOICE,
            'options' => [
                'Male',
                'Female',
            ],
            'profile_info_key' => ProfileInfoRepository::PROFILE_INFO_KEY_GENDER
        ]);

        $this->profilingQuestionRepository->createProfilingQuestion([
            'text' => 'What is your date of birth?',
            'type' => ProfilingQuestionRepository::QUESTION_TYPE_DATE,
            'profile_info_key' => ProfileInfoRepository::PROFILE_INFO_KEY_DATE_OF_BIRTH,
        ]);
    }
}

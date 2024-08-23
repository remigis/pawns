<?php

namespace App\Services;

use App\Repositories\ProfilingQuestionRepository;

class ProfilingQuestionService
{

    public function getAllProfilingQuestions()
    {
        $profilingQuestionRepository = resolve(ProfilingQuestionRepository::class);
        return $profilingQuestionRepository->getAllProfilingQuestions(['id', 'text', 'type', 'options']);
    }
}

<?php

namespace App\Interfaces;

use App\Models\ProfilingQuestion;
use Illuminate\Database\Eloquent\Collection;

interface ProfilingQuestionRepositoryInterface
{

    public function createProfilingQuestion(array $attributes):ProfilingQuestion;

    public function getAllProfilingQuestions(): Collection;

    public function getProfilingQuestionById(int $id, array $columns = ['*']): ProfilingQuestion;
}

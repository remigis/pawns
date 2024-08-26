<?php

namespace App\Repositories;

use App\Interfaces\ProfilingQuestionRepositoryInterface;
use App\Models\ProfilingQuestion;
use Illuminate\Database\Eloquent\Collection;

class ProfilingQuestionRepository implements ProfilingQuestionRepositoryInterface
{

    public const QUESTION_TYPE_SINGLE_CHOICE = 'single_choice';
    public const QUESTION_TYPE_MULTIPLE_CHOICE = 'multiple_choice';
    public const QUESTION_TYPE_DATE = 'date';
    public const QUESTION_TYPE_TEXT = 'text';

    public static array $questionTypes = [
        self::QUESTION_TYPE_SINGLE_CHOICE,
        self::QUESTION_TYPE_MULTIPLE_CHOICE,
        self::QUESTION_TYPE_DATE,
        self::QUESTION_TYPE_TEXT,
    ];

    public static array $questionsWithChoice = [
        self::QUESTION_TYPE_SINGLE_CHOICE,
        self::QUESTION_TYPE_MULTIPLE_CHOICE,
    ];

    public function createProfilingQuestion(array $attributes): ProfilingQuestion
    {
        return ProfilingQuestion::create($attributes);
    }

    public function getAllProfilingQuestions($columns = ['*']): null|Collection
    {
        return ProfilingQuestion::all($columns);
    }

    public function getProfilingQuestionById(int $id, array $columns = ['*']): null|ProfilingQuestion
    {
        return ProfilingQuestion::find($id, $columns);
    }

}

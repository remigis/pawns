<?php

namespace App\Rules;

use App\Repositories\ProfilingQuestionRepository;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Arr;

class AnswerRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $profilingQuestionRepository = resolve(ProfilingQuestionRepository::class);
        $question = $profilingQuestionRepository->getProfilingQuestionById(Arr::get($value, 'questionId'));

        if($question->isWithChoice()){
            if(!is_array($value['answer'])){
                $fail('Answer with choices must be an array');
            }

            if (!empty(array_diff($value['answer'], $question->options)))
            {
                $fail('Answer with choices must match answer options');
            }

            if($question->type === ProfilingQuestionRepository::QUESTION_TYPE_SINGLE_CHOICE){
                if(count($value['answer']) != 1){
                    $fail('Single choices answer must contain only 1 option');
                }
            }
        }

        if($question->type === ProfilingQuestionRepository::QUESTION_TYPE_DATE)
        {
            $pattern = '/^\d{4}-\d{2}-\d{2}$/';
            if (!is_string($value['answer']) || !preg_match($pattern, $value['answer'])) {
                $fail('Answer is not a valid date (YYYY-MM-DD)');
            }
        }

    }
}

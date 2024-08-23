<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\UpdateProfileRequest;
use App\Services\ProfileInfoService;
use App\Services\ProfilingQuestionService;
use App\Services\TransactionService;
use Exception;
use Illuminate\Http\JsonResponse;

class ProfilingQuestionController extends Controller
{

    public function getProfilingQuestions(ProfilingQuestionService $profilingQuestionService): JsonResponse
    {
        try{
            $questions = $profilingQuestionService->getAllProfilingQuestions();
            return response()->json([
                'questions' => $questions
            ]);
        }catch (Exception $exception){
            return response()->json(['message' => $exception->getMessage()], 500);
        }

    }

    public function updateProfile(UpdateProfileRequest $request, ProfileInfoService $profileInfoService, TransactionService $transactionService): JsonResponse
    {
        try{
            $profileInfoService->updateProfileFromAnswers($request->answers);
            $transactionService->givePointToAuthenticatedUser(5);
            return response()->json([
                'message' => 'Profile updated successfully'
            ]);
        }catch (Exception $exception){
            return response()->json(['message' => $exception->getMessage()], 500);
        }

    }
}

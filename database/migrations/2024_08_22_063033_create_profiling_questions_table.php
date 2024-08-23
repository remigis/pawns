<?php

use App\Repositories\ProfilingQuestionRepository;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiling_questions', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->enum('type', ProfilingQuestionRepository::$questionTypes)->default('text');
            $table->json('options')->nullable();
            $table->string('profile_info_key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiling_questions');
    }
};

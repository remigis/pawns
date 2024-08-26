<?php

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
        Schema::create('global_statistics', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('created_transactions');
            $table->integer('claimed_transactions');
            $table->decimal('claimed_usd', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global_statistics');
    }
};

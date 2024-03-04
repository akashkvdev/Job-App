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
        Schema::create('examtrackings', function (Blueprint $table) {
            $table->bigIncrements('exam_track_id');
            $table->string('user_id');
            $table->string('exam_id');
            $table->string('question_id');
            $table->string('user_answer');
            $table->string('qualified_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examtrackings');
    }
};

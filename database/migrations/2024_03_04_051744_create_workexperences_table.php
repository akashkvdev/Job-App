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
        Schema::create('workexperences', function (Blueprint $table) {
            $table->bigIncrements('work_exp_id');
            $table->string('user_id');
            $table->string('company_name');
            $table->string('job_title');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('responsibilities');
            $table->string('skills_accquired');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workexperences');
    }
};

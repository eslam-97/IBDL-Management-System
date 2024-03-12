<?php

use App\Models\AssessmentCategory;
use App\Models\Language;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assessment_exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('statement_one_id');
            $table->unsignedBigInteger('statement_two_id');
            $table->foreign('statement_one_id')->references('id')->on('assessment_statements')->cascadeOnDelete();
            $table->foreign('statement_two_id')->references('id')->on('assessment_statements')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_exams');
    }
};
<?php

use App\Models\AssessmentCategory;
use App\Models\Language;
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
        Schema::create('assessment_advice', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AssessmentCategory::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Language::class)->constrained()->cascadeOnDelete();
            $table->string('range_value');
            $table->string('advice')->nullable();
            $table->string('advice_if_high_candidate')->nullable();
            $table->string('advice_if_low_candidate')->nullable();
            $table->string('advice_if_high_boss')->nullable();
            $table->string('advice_if_low_boss')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_advice');
    }
};

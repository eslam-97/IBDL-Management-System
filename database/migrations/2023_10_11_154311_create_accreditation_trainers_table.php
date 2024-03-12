@@ -1,44 +0,0 @@
<?php

use App\Models\AccreditationCenter;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::connection('mysql_second')->hasTable('accreditation_trainers')) {
            Schema::connection('mysql_second')->create('accreditation_trainers', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email');
                $table->string('phone');
                $table->string('country');
                $table->string('city');
                $table->string('birth_date');
                $table->string('gender');
                $table->string('image')->nullable();
                $table->string('title');
                $table->string('company');
                $table->string('training_field');
                $table->string('training_hours');
                $table->string('brief');
                $table->string('cv')->nullable();
                $table->string('type_accreditation_trainer');
                $table->foreignIdFor(AccreditationCenter::class)->constrained()->cascadeOnDelete();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accreditation_trainers');
    }
};
@@ -1,45 +0,0 @@
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::connection('mysql_second')->hasTable('accreditation_centers')) {
            Schema::connection('mysql_second')->create('accreditation_centers', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email');
                $table->string('phone');
                $table->string('country');
                $table->string('city');
                $table->string('field');
                $table->string('type_accreditation_center');
                $table->string('website');
                $table->string('tex_trg');
                $table->string('comm_req');
                $table->string('license');
                $table->string('quality_manual');
                $table->string('accreditation');
                $table->string('approve');
                $table->string('contact_person');
                $table->string('contact_email');
                $table->string('contact_phone');
                $table->string('contact_title');
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accreditation_centers');
    }
};
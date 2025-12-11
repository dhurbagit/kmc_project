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
        Schema::create('main_programs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sector_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('sub_sector_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();

            $table->string('code')->nullable();  // e.g. "MK-EDU-01"
            $table->string('name_en');
            $table->string('name_ne')->nullable();
            $table->text('objective')->nullable();

            $table->timestamps();
        });
    }

    // id: 1
    // sector_id: 2
    // sub_sector_id: 2  (2.2 - School Infrastructure)
    // department_id: 5  (Education Dept)
    // code: "MK-EDU-01"
    // name_en: "School Infrastructure Consolidation Program"
    // name_ne: "विद्यालय पूर्वाधार सुदृढीकरण मुख्य कार्यक्रम"

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_programs');
    }
};

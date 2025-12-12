<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();

            // Department (शाखा / विभाग)
            $table->foreignId('department_id')->constrained('departments')->cascadeOnDelete();

            // Sector (क्षेत्र)
            $table->foreignId('sector_id')->nullable()->constrained('sectors')->nullOnDelete();

            // Sub-Sector (उपक्षेत्र)
            $table->foreignId('sub_sector_id')->nullable()->constrained('sub_sectors')
                ->nullOnDelete();

            // Main Program (मुख्य कार्यक्रम) – correct table reference!
            $table->foreignId('main_program_id')->nullable()->constrained('main_programs')->nullOnDelete();

            // Program identifiers
            $table->string('code')->nullable();
            $table->string('kharcha_sanket')->nullable();

            // Names
            $table->string('name_en');
            $table->string('name_ne')->nullable();

            // Description
            $table->text('objective')->nullable();

            // Fiscal year (string because 2081/82 is not numeric year)
            $table->string('fiscal_year')->nullable();

            // Status
            $table->enum('lifecycle_status', [
                'incept',      // conceptual
                'approved',    // budget-approved
                'ongoing',     // running
                'complete',    // finished
            ])->default('incept');

            // Progress %
            $table->unsignedTinyInteger('progress_percent')->default(0);

            $table->timestamps();

            // OPTIONAL — uncomment this line ONLY IF your Program model uses SoftDeletes
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};

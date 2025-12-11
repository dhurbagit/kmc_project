<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_programs_table.php
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();

            $table
                ->foreignId('department_id')
                ->constrained('departments')
                ->cascadeOnDelete();

            $table
                ->foreignId('sector_id')
                ->nullable()
                ->constrained('sectors')
                ->nullOnDelete();

            $table
                ->foreignId('sub_sector_id')
                ->nullable()
                ->constrained('sub_sectors')
                ->nullOnDelete();

            // ⚠ self-FK: by default constrained() on main_program_id
            // would look for "main_programs" table 👎
            $table
                ->foreignId('main_program_id')
                ->nullable()
                ->constrained('programs')
                ->nullOnDelete();

            $table->string('code')->nullable();
            $table->string('kharcha_sanket')->nullable();

            $table->string('name_en');
            $table->string('name_ne')->nullable();

            $table->text('objective')->nullable();
            $table->year('fiscal_year')->nullable();

            $table
                ->enum('lifecycle_status', ['incept', 'approved', 'ongoing', 'complete'])
                ->default('incept');

            $table->unsignedTinyInteger('progress_percent')->default(0);

            $table->timestamps();
        });
    }

    //     id: 101
    // department_id: 2 (Urban Management)
    // sector_id: 1 (Smart Governance)
    // sub_sector_id: null
    // main_program_id: 3

    // code: "UMD-2081-005"
    // kharcha_sanket: "3370132"

    // name_en: "Construction of Indoor Sports Hall for Senior Citizens"
    // name_ne: "जेष्ठ नागरिकका लागि ईन्डोर खेलकुद हल निर्माण"
    // fiscal_year: 2081
    // lifecycle_status: "approved"
    // progress_percent: 40

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};

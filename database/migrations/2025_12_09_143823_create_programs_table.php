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
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();

            $table->string('code')->nullable();  // KMC program code
            $table->string('name_en');
            $table->string('name_ne')->nullable();

            $table->text('objective')->nullable();
            $table->year('fiscal_year')->nullable();

            // evaluation regime status
            $table
                ->enum('lifecycle_status', ['incept', 'approved', 'ongoing', 'complete'])
                ->default('incept');

            $table->unsignedTinyInteger('progress_percent')->default(0);  // 0–100

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};

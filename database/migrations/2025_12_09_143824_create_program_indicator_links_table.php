<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_program_indicator_links_table.php
    public function up(): void
    {
        Schema::create('program_indicator_links', function (Blueprint $table) {
            $table->id();

            $table->foreignId('program_id')->constrained()->cascadeOnDelete();
            $table->foreignId('indicator_id')->constrained()->cascadeOnDelete();

            // direct or indirect contribution
            $table->enum('link_type', ['direct', 'indirect'])->default('direct');

            // extent 0–5 (your scale)
            $table->unsignedTinyInteger('extent_score')->default(0);  // 0..5

            // evidence level: discuss, research, concurrence, declare
            $table
                ->enum('evidence_level', ['discuss', 'research', 'concurrence', 'declare'])
                ->default('discuss');

            // optional weight for future analytics
            $table->unsignedTinyInteger('weight')->default(1);

            $table->timestamps();

            $table->unique(['program_id', 'indicator_id', 'link_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_indicator_links');
    }
};

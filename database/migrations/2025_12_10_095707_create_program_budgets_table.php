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
        Schema::create('program_budgets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('program_id')->constrained()->cascadeOnDelete();

            $table->year('fiscal_year')->nullable();  // or string if using 2081/82 format
            $table->string('fiscal_code')->nullable();  // e.g. "2081/82"

            $table->decimal('allocated_budget', 18, 2)->default(0);  // sanctioned
            $table->decimal('revised_budget', 18, 2)->nullable();  // संशोधित बजेट
            $table->decimal('expenditure', 18, 2)->nullable();  // खर्च

            $table->timestamps();
        });
    }

    // program_id: 101
    // fiscal_year: 2081
    // fiscal_code: "2081/82"
    // allocated_budget: 10000000.00
    // revised_budget: 8500000.00
    // expenditure: 7200000.00

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_budgets');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_indicators_table.php
public function up(): void
{
    Schema::create('indicators', function (Blueprint $table) {
        $table->id();
        $table->enum('source_type', ['SDG', 'ISO37120', 'ISO37122', 'SCI']); // flexible
        $table->string('code');    // e.g. SDG-11.5.1, ISO37120-1.1, SCI-MOB-01
        $table->string('short_name');
        $table->text('description')->nullable();

        // For SDG:
        $table->string('goal_code')->nullable();   // e.g. 11
        $table->string('target_code')->nullable(); // e.g. 11.5




        
        // Units and direction
        $table->string('unit')->nullable();         // %, score, ratio
        $table->boolean('higher_is_better')->default(true);

        $table->timestamps();

        $table->unique(['source_type', 'code']);
    });
}


// [
//     'source_type'      => 'SDG',
//     'code'             => '11.5.1',
//     'short_name'       => 'Disaster mortality rate',
//     'description'      => 'Deaths and affected persons due to disasters per 100,000 population',
//     'goal_code'        => '11',
//     'target_code'      => '11.5',
//     'unit'             => 'per 100,000 population',
//     'higher_is_better' => false,
// ]




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicators');
    }
};

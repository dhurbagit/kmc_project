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
        Schema::create('sectors', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();  // e.g. "1", "2", "3", "2.1"
            $table->string('name_en');
            $table->string('name_ne')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    // id: 1, code: "1",   name_en: "Smart Governance", name_ne: "सुशासन क्षेत्र"
    // id: 2, code: "2",   name_en: "Education",        name_ne: "शिक्षा क्षेत्र"
    // id: 3, code: "3",   name_en: "Environment",      name_ne: "वातावरण क्षेत्र"

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sectors');
    }
};

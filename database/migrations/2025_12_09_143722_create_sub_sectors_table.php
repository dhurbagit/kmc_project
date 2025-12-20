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
        Schema::create('sub_sectors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sector_id')->constrained()->cascadeOnDelete();

            $table->string('code');  // e.g. "2.1", "2.2"
            $table->string('name_en');
            $table->string('name_ne')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();

            $table->unique(['sector_id', 'code']);
        });
    }

// sector_id: 2, code: "2.1", name_en: "Quality Education",  name_ne: "शिक्षा गुणस्तर सुधार"
// sector_id: 2, code: "2.2", name_en: "School Infrastructure", name_ne: "विद्यालय पूर्वाधार विकास"


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_sectors');
    }
};

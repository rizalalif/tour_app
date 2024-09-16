<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('iteneraries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('holiday_package_id')->constrained('holiday_packages')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('day_number');
            $table->text('description');
            $table->string('activity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iteneraries');
    }
};

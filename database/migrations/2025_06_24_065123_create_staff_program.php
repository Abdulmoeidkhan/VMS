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
        Schema::create('staff_program', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->references('id')->on('government_staff')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('program_id')->references('id')->on('programs')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_program');
    }
};

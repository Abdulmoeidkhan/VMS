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
        Schema::create('government_staff', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique();
            $table->uuid('rank');
            $table->string('name')->unique();
            $table->string('designation');
            $table->string('identity')->unique();
            $table->string('address');
            $table->bigInteger('contact')->unique();
            $table->string('code')->unique();
            $table->unsignedBigInteger('invited_by');
            $table->unsignedBigInteger('staff_category')->nullable();
            $table->uuid('picture')->nullable();
            $table->unsignedBigInteger('country');
            $table->string('city');
            $table->string('car_sticker_color')->nullable();
            $table->string('car_sticker_no')->nullable();
            $table->string('invitaion_no')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->foreign('invited_by')->references('id')->on('invitees')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('staff_category')->references('id')->on('staff_categories')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('country')->references('id')->on('countries')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('government_staff');
    }
};

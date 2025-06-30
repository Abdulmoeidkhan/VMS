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
        Schema::create('government_organizations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique();
            $table->string('name')->unique();
            $table->string('address')->unique();
            $table->unsignedBigInteger('country');
            $table->string('city');
            $table->string('code');
            $table->unsignedBigInteger('group');
            $table->integer('ref_no')->nullable();
            $table->integer('allowed_quantity')->default(1);
            $table->integer('status')->default(1);
            $table->string('head_name');
            $table->bigInteger('head_contact')->unique();
            $table->string('head_email')->unique();
            $table->timestamps();
            $table->foreign('group')->references('id')->on('groups')
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
        Schema::dropIfExists('government_organizations');
    }
};

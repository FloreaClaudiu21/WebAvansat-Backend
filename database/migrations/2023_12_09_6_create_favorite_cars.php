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
        Schema::create('favorite_cars', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('cars_id')->unsigned();
            $table->unsignedBigInteger('users_id')->unsigned();
            ///////////////////////////////////////////////////
            $table->foreign('cars_id')->references('id')->on('cars');
            $table->foreign('users_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorite_cars');
    }
};

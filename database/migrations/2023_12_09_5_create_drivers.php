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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string("phone");
            $table->date("birthDate");
            $table->string("lastName");
            $table->string("firstName");
            $table->unsignedBigInteger('cars_id')->unsigned()->nullable();
            $table->unsignedBigInteger('licenses_id')->unsigned()->nullable();
            //$table->unsignedBigInteger('users_id')->unsigned();
            /////////////////////////////////////////////////////
            $table->foreign('licenses_id')->references('id')->on('licenses');
            $table->foreign('cars_id')->references('id')->on('cars')->nullable();
            //$table->foreign('users_id')->references('id')->on('users');
            /////////////////////////////////////////////////////////////
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};

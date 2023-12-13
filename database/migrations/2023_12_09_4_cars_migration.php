<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('cars', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('plateNumber')->unique();
            $table->string('color');
            $table->string('features');
            $table->string('mileage');
            $table->string('fuelType');
            $table->string('transmission');
            $table->string('registrationDate');
            $table->unsignedBigInteger('car_brands_id')->unsigned();
            $table->timestamps();
            /////////////////////
            $table->foreign('car_brands_id')->references('id')->on('car_brands');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};

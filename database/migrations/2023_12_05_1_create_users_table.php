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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->date("birthDate");
            $table->string("phone");
            $table->string("password");
            $table->string("lastName");
            $table->string("firstName");
            $table->string("email")->unique();
            $table->string('userName')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('users');
    }
};

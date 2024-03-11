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
        Schema::create('famous_advertises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('famous_id');
            $table->foreign('famous_id')->references('id')->on('users');
            $table->unsignedBigInteger('advertise_id');
            $table->foreign('advertise_id')->references('id')->on('advertises');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('famous_advertises');
    }
};

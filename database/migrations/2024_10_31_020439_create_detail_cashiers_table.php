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
        Schema::create('detail_cashiers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cashiers_id');
            $table->unsignedBigInteger('bedrooms_id');
            $table->integer('duration');
            $table->integer('total_price_per_room');
            $table->dateTime('check_in');
            $table->dateTime('check_out');
            $table->timestamps();

            $table->foreign('cashiers_id')->references('id')->on('cashiers');
            $table->foreign('bedrooms_id')->references('id')->on('bedrooms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_cashiers');
    }
};

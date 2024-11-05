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
        Schema::create('bedroom_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bedrooms_id');
            $table->string('image_url');
            $table->timestamps();

            $table->foreign('bedrooms_id')->references('id')->on('bedrooms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bedroom_images');
    }
};

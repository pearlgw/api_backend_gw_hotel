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
        Schema::create('bedrooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_bedrooms_id');
            $table->string('code_bedroom');
            $table->string('main_image_url');
            $table->boolean('is_available')->default(false);
            $table->text('description');
            $table->timestamps();

            $table->foreign('category_bedrooms_id')->references('id')->on('category_bedrooms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bedrooms');
    }
};

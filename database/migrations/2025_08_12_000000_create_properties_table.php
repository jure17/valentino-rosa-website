<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['affitti', 'vendite']);
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('available')->nullable();
            $table->text('details')->nullable();
            $table->string('price')->nullable();
            $table->string('image_path');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
}; 
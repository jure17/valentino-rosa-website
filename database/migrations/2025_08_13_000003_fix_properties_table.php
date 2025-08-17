<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Drop the old table and recreate it with proper structure
        Schema::dropIfExists('properties');
        
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->enum('type', ['vendite', 'affitti']);
            $table->string('disponibilita')->nullable();
            $table->string('location')->nullable();
            $table->json('features')->nullable();
            $table->json('contact_info')->nullable();
            $table->string('pdf_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
}; 
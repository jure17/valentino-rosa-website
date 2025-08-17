<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('pdf_path')->nullable()->after('contact_info');
            $table->string('disponibilita')->change(); // Change from boolean to string
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('pdf_path');
            $table->boolean('disponibilita')->change(); // Revert to boolean
        });
    }
}; 
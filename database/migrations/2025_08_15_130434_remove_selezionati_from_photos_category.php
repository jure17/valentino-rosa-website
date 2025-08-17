<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, update any existing photos with 'selezionati' category to 'soprastrutture'
        DB::table('photos')->where('category', 'selezionati')->update(['category' => 'soprastrutture']);
        
        // Then modify the enum to remove 'selezionati'
        DB::statement("ALTER TABLE photos MODIFY COLUMN category ENUM('soprastrutture', 'sottostrutture', 'muri', 'mezzi')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add 'selezionati' back to the enum
        DB::statement("ALTER TABLE photos MODIFY COLUMN category ENUM('soprastrutture', 'sottostrutture', 'muri', 'mezzi', 'selezionati')");
    }
};

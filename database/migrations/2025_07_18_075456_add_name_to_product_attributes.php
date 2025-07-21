<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('product_attributes', function (Blueprint $table) {
            $table->string('name')->after('id'); // Menambahkan kolom 'name' setelah kolom 'id'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_attributes', function (Blueprint $table) {
            $table->dropColumn('name'); // Menghapus kolom 'name' jika migrasi dibatalkan
        });
    }
};

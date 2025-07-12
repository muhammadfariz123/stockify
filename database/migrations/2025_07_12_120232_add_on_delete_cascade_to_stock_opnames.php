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
        Schema::table('stock_opnames', function (Blueprint $table) {
            // Hapus foreign key yang lama jika ada
            $table->dropForeign(['product_id']);  // Pastikan nama kolom yang digunakan sesuai dengan yang ada di database

            // Tambahkan foreign key dengan ON DELETE CASCADE
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');  // Menambahkan ON DELETE CASCADE
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_opnames', function (Blueprint $table) {
            // Drop foreign key jika migrasi dibatalkan
            $table->dropForeign(['product_id']);
        });
    }
};

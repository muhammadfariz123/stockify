<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionNullableToProductsTable extends Migration
{
    /**
     * Jalankan migration untuk menambahkan kolom 'description' ke tabel 'products'.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('description')->nullable()->after('name'); // Menambahkan kolom 'description' yang nullable setelah kolom 'name'
        });
    }

    /**
     * Rollback migration untuk menghapus kolom 'description'.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('description'); // Menghapus kolom 'description'
        });
    }
}

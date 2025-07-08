<?php
// database/migrations/2025_07_08_123456_update_sale_price_column_in_products_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSalePriceColumnInProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Ubah kolom 'sale_price' menjadi tidak nullable
            $table->decimal('sale_price', 10, 2)->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Mengembalikan kolom 'sale_price' menjadi nullable
            $table->decimal('sale_price', 10, 2)->nullable()->change();
        });
    }
}

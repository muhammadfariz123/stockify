<?php
// database/migrations/xxxx_xx_xx_add_supplier_id_to_products_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupplierIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('supplier_id')->nullable(); // Menambahkan kolom supplier_id
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('set null'); // Menambahkan relasi ke tabel suppliers
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']); // Menghapus relasi
            $table->dropColumn('supplier_id'); // Menghapus kolom supplier_id
        });
    }
}

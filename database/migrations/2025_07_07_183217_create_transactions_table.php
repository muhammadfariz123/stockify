<?php
// 2025_07_07_151522_create_transactions_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Menghubungkan ke produk
            $table->enum('type', ['in', 'out']); // Tipe transaksi: masuk atau keluar
            $table->integer('quantity');
            $table->timestamp('transaction_date')->useCurrent(); // Tanggal transaksi
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Hapus foreign key sebelum menghapus tabel
            $table->dropForeign(['product_id']);
        });

        Schema::dropIfExists('transactions');
    }
}

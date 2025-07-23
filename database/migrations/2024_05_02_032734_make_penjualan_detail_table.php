<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualan_detail', function (Blueprint $table) {
            $table->increments('id_penjualan_detail');
            $table->integer('id_penjualan')->unsigned();
            $table->integer('id_produk')->unsigned();
            $table->integer('harga_jual');
            $table->integer('jumlah');
            $table->tinyInteger('diskon')->default(0);
            $table->integer('subtotal');
            $table->timestamps();
            $table->foreign('id_penjualan')->references('id_penjualan')->on('penjualan')->onDelete('cascade');
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan_detail');
    }
};

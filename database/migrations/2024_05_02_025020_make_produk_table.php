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
        Schema::create('produk', function (Blueprint $table) {
            $table->increments('id_produk');
            $table->unsignedInteger('id_kategori');
            $table->string('nama_produk')->unique();
            $table->string('merek')->nullable();
            $table->integer('harga_beli');
            $table->tinyInteger('diskon')->nullable();
            $table->integer('harga_jual');
            $table->integer('stok')->default(0);
            $table->timestamps();
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};

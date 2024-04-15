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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('barcode')->nullable();
            $table->unsignedBigInteger('kategori_id');
            $table->string('nama_barang')->nullable();
            $table->string('merk')->nullable();
            $table->integer('harga_beli')->nullable();
            $table->integer('harga_jual')->nullable();
            $table->string('satuan_barang')->nullable();
            $table->integer('stock')->nullable();
            $table->string('tgl_input')->nullable();
            $table->string('tgl_update')->nullable();
            $table->timestamps();
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};

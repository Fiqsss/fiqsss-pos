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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('member_id')->nullable();
            $table->integer('jumlah')->default(0);
            $table->integer('total')->default(0)->nullable();
            $table->date('tanggal_transaksi')->now();
            $table->timestamps();
            $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};

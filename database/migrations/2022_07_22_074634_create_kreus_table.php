<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kreuses', function (Blueprint $table) {
            $table->id();
            $table->integer('bulan');
            $table->string('kategori');
            $table->string('proker');
            $table->string('sumber')->nullable();
            $table->integer('pemasukan')->nullable();
            $table->string('pj')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('pengeluaran')->nullable();
            $table->date('tanggal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kreus');
    }
};

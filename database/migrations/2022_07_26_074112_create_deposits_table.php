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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengurus_id');
            $table->integer('raplen')->default(0);
            $table->integer('jahim')->default(0);
            $table->integer('wisuda')->default(0);
            $table->integer('pesek')->default(0);
            $table->integer('proker')->default(0);
            $table->integer('lainya')->default(0);
            $table->integer('sisa')->default(0);
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
        Schema::dropIfExists('deposits');
    }
};

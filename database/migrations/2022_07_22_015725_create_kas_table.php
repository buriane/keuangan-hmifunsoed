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
        Schema::create('kas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengurus_id');
            $table->integer('april')->default(0);
            $table->integer('mei')->default(0);
            $table->integer('juni')->default(0);
            $table->integer('juli')->default(0);
            $table->integer('agustus')->default(0);
            $table->integer('september')->default(0);
            $table->integer('oktober')->default(0);
            $table->integer('november')->default(0);
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
        Schema::dropIfExists('kas');
    }
};

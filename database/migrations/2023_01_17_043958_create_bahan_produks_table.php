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
        Schema::create('bahan_produks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->references('id')->on('produks')->onDelete('cascade');
            $table->foreignId('bahan_id')->references('id')->on('bahans')->onDelete('cascade');
            $table->integer('jumlah');
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
        Schema::dropIfExists('bahan_produks');
    }
};

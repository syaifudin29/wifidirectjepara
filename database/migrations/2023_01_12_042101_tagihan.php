<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tagihan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id();
            $table->string('no_tagihan');
            $table->foreignId('pelanggan_id');
            $table->text('no_pembayaran');
            $table->date('tgl_tagihan');
            $table->integer('ttl_byr');
            $table->integer('denda');
            $table->enum('status', ['gagal', 'sukses', 'proses', 'belum']);
            $table->string('metode');
            $table->enum('is_active', ['0', '1']);
            $table->date('tgl_byr');
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
        Schema::dropIfExists('tagihan');
    }
}

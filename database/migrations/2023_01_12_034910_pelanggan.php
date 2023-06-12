<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pelanggan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('no_langganan');
            $table->bigInteger('ktp');
            $table->string('nama');
            $table->string('no_hp');
            $table->longText('alamat');
            $table->string('email');
            $table->date('jatuhtempo');
            $table->string('username');
            $table->longText('password');
            $table->foreignId('paket_id');
            $table->text('photo');
            $table->enum('level', ['pelanggan', 'admin']);
            $table->enum('is_active', ['0', '1'])->default('1');
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
        Schema::dropIfExists('pelanggan');
    }
}

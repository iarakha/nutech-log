<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Wo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wo', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_lokasi');
            $table->integer('id_perangkat');
            $table->integer('id_part');
            $table->integer('id_masalah');
            $table->string('kode_wo')->unique();
            $table->string('jenis_laporan', 100);
            $table->string('project', 100);
            $table->string('penyebab');
            $table->string('solusi');
            $table->string('sumber', 100);
            $table->enum('status',['on progress','selesai','pending']);
            $table->date('tanggal_masalah');
            $table->time('jam_masalah');
            $table->date('tanggal_selesai');
            $table->time('jam_selesai');
            $table->string('keterangan');
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
        Schema::dropIfExists('wo');
    }
}

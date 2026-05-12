<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuangansTable extends Migration
{
    /**
     * Run the migrations.
     */

    public function up()
    {
        Schema::create('ruangans', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | DATA RUANGAN
            |--------------------------------------------------------------------------
            */

            $table->string('nama_ruangan');

            $table->string('lokasi')->nullable();

            $table->text('keterangan')->nullable();

            /*
            |--------------------------------------------------------------------------
            | TIMESTAMP
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */

    public function down()
    {
        Schema::dropIfExists('ruangans');
    }
}
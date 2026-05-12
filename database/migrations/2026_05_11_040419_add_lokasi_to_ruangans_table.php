<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLokasiToRuangansTable extends Migration
{
    public function up()
    {
        Schema::table('ruangans', function (Blueprint $table) {

            $table->string('lokasi')
                  ->nullable()
                  ->after('nama_ruangan');

        });
    }

    public function down()
    {
        Schema::table('ruangans', function (Blueprint $table) {

            $table->dropColumn('lokasi');

        });
    }
}
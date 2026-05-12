<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpgradeTableInspeksis extends Migration
{
    public function up()
    {
        Schema::table('inspeksis', function (Blueprint $table) {

            $table->date('tanggal')->nullable();

            $table->text('jawaban')->nullable();

            $table->text('keterangan')->nullable();

            $table->string('nama_petugas_k3rs')->nullable();

            $table->string('nama_petugas_ruangan')->nullable();

            $table->longText('ttd_k3rs')->nullable();

            $table->longText('ttd_ruangan')->nullable();

        });
    }

    public function down()
    {
        Schema::table('inspeksis', function (Blueprint $table) {

            $table->dropColumn([
                'tanggal',
                'jawaban',
                'keterangan',
                'nama_petugas_k3rs',
                'nama_petugas_ruangan',
                'ttd_k3rs',
                'ttd_ruangan'
            ]);

        });
    }
}
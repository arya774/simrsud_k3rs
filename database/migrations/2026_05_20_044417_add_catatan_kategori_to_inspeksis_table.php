<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCatatanKategoriToInspeksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inspeksis', function (Blueprint $table) {

            /*
            |----------------------------------------------------------
            | CATATAN PER KATEGORI
            |----------------------------------------------------------
            | Disimpan dalam format JSON
            */
            $table->longText('catatan_kategori')
                  ->nullable()
                  ->after('keterangan');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inspeksis', function (Blueprint $table) {

            $table->dropColumn('catatan_kategori');

        });
    }
}
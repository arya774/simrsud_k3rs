<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropKategoriIdFromInspeksisTable extends Migration
{
    public function up()
    {
        if (Schema::hasColumn('inspeksis', 'kategori_id')) {

            Schema::table('inspeksis', function (Blueprint $table) {

                // langsung hapus kolom
                $table->dropColumn('kategori_id');

            });
        }
    }

    public function down()
    {
        if (!Schema::hasColumn('inspeksis', 'kategori_id')) {

            Schema::table('inspeksis', function (Blueprint $table) {

                $table->unsignedBigInteger('kategori_id')->nullable();

            });
        }
    }
}
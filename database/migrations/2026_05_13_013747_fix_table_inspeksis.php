<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixTableInspeksis extends Migration
{
    public function up()
    {
        Schema::table('inspeksis', function (Blueprint $table) {

            if (!Schema::hasColumn('inspeksis', 'jawaban')) {
                $table->longText('jawaban')->nullable();
            }

            if (!Schema::hasColumn('inspeksis', 'hasil')) {
                $table->integer('hasil')->default(0);
            }

            if (!Schema::hasColumn('inspeksis', 'ttd_k3rs')) {
                $table->longText('ttd_k3rs')->nullable();
            }

            if (!Schema::hasColumn('inspeksis', 'ttd_ruangan')) {
                $table->longText('ttd_ruangan')->nullable();
            }
        });
    }

    public function down()
    {
        //
    }
}
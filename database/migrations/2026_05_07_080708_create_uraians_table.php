<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUraiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uraians', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('kategori_id');

            $table->string('nama_uraian');

            $table->timestamps();

            $table->foreign('kategori_id')
                  ->references('id')
                  ->on('kategoris')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uraians');
    }
}
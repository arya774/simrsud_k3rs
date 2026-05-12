<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubUraiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_uraians', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('uraian_id');

            $table->string('nama_sub_uraian');

            $table->timestamps();

            $table->foreign('uraian_id')
                  ->references('id')
                  ->on('uraians')
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
        Schema::dropIfExists('sub_uraians');
    }
}
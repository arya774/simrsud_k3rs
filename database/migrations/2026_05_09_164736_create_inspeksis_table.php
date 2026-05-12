<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspeksisTable extends Migration
{
    /**
     * Run the migrations.
     */

    public function up()
    {
        Schema::create('inspeksis', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | RELASI
            |--------------------------------------------------------------------------
            */

            $table->foreignId('kategori_id')
                  ->constrained('kategoris')
                  ->onDelete('cascade');

            $table->foreignId('uraian_id')
                  ->constrained('uraians')
                  ->onDelete('cascade');

            $table->foreignId('sub_uraian_id')
                  ->constrained('sub_uraians')
                  ->onDelete('cascade');

            $table->foreignId('ruangan_id')
                  ->constrained('ruangans')
                  ->onDelete('cascade');

            /*
            |--------------------------------------------------------------------------
            | DATA INSPEKSI
            |--------------------------------------------------------------------------
            */

            $table->date('tanggal_inspeksi');

            $table->text('catatan')->nullable();

            $table->enum('status', [
                'Baik',
                'Rusak',
                'Perlu Perbaikan'
            ]);

            /*
            |--------------------------------------------------------------------------
            | FOTO
            |--------------------------------------------------------------------------
            */

            $table->string('foto')->nullable();

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
        Schema::dropIfExists('inspeksis');
    }
}
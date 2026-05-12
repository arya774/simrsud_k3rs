<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inspeksis', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | RELASI UTAMA
            |--------------------------------------------------------------------------
            */
            $table->foreignId('kategori_id')
                ->constrained('kategoris')
                ->cascadeOnDelete();

            $table->foreignId('ruangan_id')
                ->constrained('ruangans')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | DATA INSPEKSI
            |--------------------------------------------------------------------------
            */
            $table->date('tanggal');

            $table->json('jawaban')->nullable();

            $table->integer('hasil')->default(0);

            $table->text('keterangan')->nullable();

            /*
            |--------------------------------------------------------------------------
            | PETUGAS
            |--------------------------------------------------------------------------
            */
            $table->string('nama_petugas_k3rs')->nullable();

            $table->string('nama_petugas_ruangan')->nullable();

            /*
            |--------------------------------------------------------------------------
            | TANDA TANGAN
            |--------------------------------------------------------------------------
            */
            $table->longText('ttd_k3rs')->nullable();

            $table->longText('ttd_ruangan')->nullable();

            /*
            |--------------------------------------------------------------------------
            | TIMESTAMP
            |--------------------------------------------------------------------------
            */
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspeksis');
    }
};
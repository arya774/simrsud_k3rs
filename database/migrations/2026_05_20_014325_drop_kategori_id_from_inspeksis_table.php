<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropKategoriIdFromInspeksisTable extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('inspeksis', 'kategori_id')) {

            Schema::table('inspeksis', function (Blueprint $table) {

                // Hapus foreign key dulu
                try {
                    $table->dropForeign(['kategori_id']);
                } catch (\Exception $e) {
                    // fallback kalau nama FK berbeda
                    try {
                        $table->dropForeign('inspeksis_kategori_id_foreign');
                    } catch (\Exception $e) {
                        // biarkan saja kalau sudah tidak ada
                    }
                }

                // Baru hapus kolom
                $table->dropColumn('kategori_id');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('inspeksis', 'kategori_id')) {

            Schema::table('inspeksis', function (Blueprint $table) {

                $table->foreignId('kategori_id')
                      ->nullable()
                      ->constrained('kategoris')
                      ->cascadeOnDelete();
            });
        }
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_inspeksis', function (Blueprint $table) {

            $table->id();

            $table->foreignId('inspeksi_id')

                ->constrained('inspeksis')

                ->onDelete('cascade');

            $table->foreignId('sub_uraian_id')

                ->constrained('sub_uraians')

                ->onDelete('cascade');

            $table->string('jawaban')->nullable();

            $table->text('keterangan')->nullable();

            $table->integer('nilai')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_inspeksis');
    }
};

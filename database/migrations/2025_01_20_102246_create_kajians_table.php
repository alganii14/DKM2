<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
<<<<<<< HEAD
    {
        Schema::create('kajians', function (Blueprint $table) {
            $table->id();
            $table->string('judul_kajian');
            $table->text('deskripsi_kajian');
            $table->date('tanggal_kajian');
            $table->string('foto_kajian');
            $table->string('foto_ustad');
            $table->string('nama_ustad');
            $table->timestamps();
        });
    }
=======
{
    Schema::create('kajians', function (Blueprint $table) {
        $table->id();
        $table->string('judul_kajian');
        $table->text('deskripsi_kajian');
        $table->date('tanggal_kajian');
        $table->string('foto_kajian');
        $table->string('foto_ustad')->nullable();
        $table->string('nama_ustad')->nullable();
        $table->timestamps();
    });
}

>>>>>>> a4508c7 (zakat)

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kajians');
    }
};

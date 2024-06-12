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
    {
        Schema::create('suratusahas', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->bigInteger('tanda_tangan');
            $table->date('tanggal_surat_dibuat');
            $table->string('nama_lengkap');
            $table->string('nik');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('alamat');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('pekerjaan');
            $table->string('tempat_pekerjaan')->nullable();
            $table->string('bidang_usaha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suratusahas');
    }
};

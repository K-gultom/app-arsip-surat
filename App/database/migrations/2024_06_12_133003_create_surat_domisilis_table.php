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
        Schema::create('surat_domisilis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tanda_tangan');
            $table->string('nomor_surat');
            $table->string('nama_lengkap');
            $table->string('nik');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('kewarganegaraan', ['WNI', 'WNA']);
            $table->enum('agama', ['Islam', 'Khatolik', 'Kristen', 'Buddha', 'Hindu', 'Agama_Kepercayaan']);
            $table->enum('status_perkawinan', ['Kawin', 'Belum_Kawin', 'Cerai']);
            $table->string('pekerjaan_pemohon');
            $table->string('alamat');
            $table->date('tgl_surat_dibuat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_domisilis');
    }
};

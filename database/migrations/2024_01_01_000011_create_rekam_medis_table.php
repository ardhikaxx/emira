<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();
            $table->string('no_rm_kunjungan')->unique();
            $table->foreignId('kunjungan_id')->constrained('kunjungans')->onDelete('cascade');
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('dokter_id')->constrained('dokters')->onDelete('cascade');
            $table->datetime('tanggal_periksa');
            $table->text('anamnesis')->nullable();
            $table->text('riwayat_penyakit_dahulu')->nullable();
            $table->text('riwayat_penyakit_keluarga')->nullable();
            $table->text('riwayat_alergi')->nullable();
            $table->text('riwayat_obat_rutin')->nullable();
            $table->text('catatan_dokter')->nullable();
            $table->text('rencana_tindak_lanjut')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->string('no_kunjungan')->unique();
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('dokter_id')->constrained('dokters')->onDelete('cascade');
            $table->foreignId('poli_id')->constrained('polis')->onDelete('cascade');
            $table->foreignId('antrian_id')->nullable()->constrained('antrians')->onDelete('set null');
            $table->date('tanggal_kunjungan');
            $table->time('jam_datang')->nullable();
            $table->time('jam_dilayani')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->enum('jenis_kunjungan', ['rawat_jalan', 'rawat_inap', 'ugd', 'kontrol']);
            $table->enum('jenis_pembayaran', ['umum', 'bpjs'])->default('umum');
            $table->string('no_bpjs_kunjungan')->nullable();
            $table->text('keluhan_utama')->nullable();
            $table->enum('status', ['menunggu', 'dipanggil', 'dalam_pemeriksaan', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->text('catatan_pendaftaran')->nullable();
            $table->foreignId('registered_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kunjungans');
    }
};

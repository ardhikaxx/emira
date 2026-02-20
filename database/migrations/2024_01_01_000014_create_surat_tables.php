<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_rujukans', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat')->unique();
            $table->foreignId('kunjungan_id')->constrained('kunjungans')->onDelete('cascade');
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('dokter_id')->constrained('dokters')->onDelete('cascade');
            $table->foreignId('icd10_id')->nullable()->constrained('icd10_masters')->onDelete('set null');
            $table->string('tujuan_fasilitas')->nullable();
            $table->string('dokter_tujuan')->nullable();
            $table->string('spesialisasi_tujuan')->nullable();
            $table->text('anamnesis_singkat')->nullable();
            $table->text('terapi_diberikan')->nullable();
            $table->text('alasan_rujukan')->nullable();
            $table->enum('jenis_rujukan', ['internal', 'eksternal', 'balik'])->default('eksternal');
            $table->date('tanggal_surat');
            $table->timestamps();
        });

        Schema::create('surat_keterangan_sakits', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat')->unique();
            $table->foreignId('kunjungan_id')->constrained('kunjungans')->onDelete('cascade');
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('dokter_id')->constrained('dokters')->onDelete('cascade');
            $table->date('tanggal_awal_sakit');
            $table->date('tanggal_akhir_sakit');
            $table->integer('jumlah_hari');
            $table->string('diagnosa_singkat')->nullable();
            $table->text('keterangan')->nullable();
            $table->date('tanggal_surat');
            $table->timestamps();
        });

        Schema::create('surat_keterangan_sehats', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat')->unique();
            $table->foreignId('kunjungan_id')->constrained('kunjungans')->onDelete('cascade');
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('dokter_id')->constrained('dokters')->onDelete('cascade');
            $table->string('keperluan', 300)->nullable();
            $table->text('keterangan')->nullable();
            $table->date('tanggal_surat');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_keterangan_sehats');
        Schema::dropIfExists('surat_keterangan_sakits');
        Schema::dropIfExists('surat_rujukans');
    }
};

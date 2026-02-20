<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rawat_inaps', function (Blueprint $table) {
            $table->id();
            $table->string('no_rawat_inap')->unique();
            $table->foreignId('kunjungan_id')->constrained('kunjungans')->onDelete('cascade');
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('dokter_id')->constrained('dokters')->onDelete('cascade');
            $table->foreignId('ruangan_id')->constrained('ruangans')->onDelete('cascade');
            $table->string('no_tempat_tidur', 10);
            $table->date('tanggal_masuk');
            $table->time('jam_masuk');
            $table->date('tanggal_keluar')->nullable();
            $table->time('jam_keluar')->nullable();
            $table->text('kondisi_masuk')->nullable();
            $table->text('kondisi_keluar')->nullable();
            $table->enum('cara_keluar', ['pulang_biasa', 'atas_permintaan_sendiri', 'meninggal', 'rujuk', 'pindah_ruangan'])->nullable();
            $table->enum('status', ['aktif', 'selesai'])->default('aktif');
            $table->timestamps();
        });

        Schema::create('perkembangan_pasiens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rawat_inap_id')->constrained('rawat_inaps')->onDelete('cascade');
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('jam');
            $table->text('soap_subjective')->nullable();
            $table->text('soap_objective')->nullable();
            $table->text('soap_assessment')->nullable();
            $table->text('soap_plan')->nullable();
            $table->foreignId('dicatat_oleh')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perkembangan_pasiens');
        Schema::dropIfExists('rawat_inaps');
    }
};

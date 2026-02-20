<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vital_signs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kunjungan_id')->constrained('kunjungans')->onDelete('cascade');
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->integer('tekanan_darah_sistol')->nullable();
            $table->integer('tekanan_darah_diastol')->nullable();
            $table->integer('nadi')->nullable();
            $table->integer('pernapasan')->nullable();
            $table->decimal('suhu', 4, 1)->nullable();
            $table->decimal('saturasi_oksigen', 5, 2)->nullable();
            $table->decimal('berat_badan', 6, 2)->nullable();
            $table->decimal('tinggi_badan', 5, 2)->nullable();
            $table->decimal('bmi', 5, 2)->nullable();
            $table->decimal('lingkar_perut', 5, 2)->nullable();
            $table->integer('gula_darah_sewaktu')->nullable();
            $table->enum('kesadaran', ['composmentis', 'apatis', 'somnolen', 'sopor', 'koma'])->nullable();
            $table->text('catatan')->nullable();
            $table->foreignId('recorded_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('diagnosas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekam_medis_id')->constrained('rekam_medis')->onDelete('cascade');
            $table->foreignId('icd10_id')->constrained('icd10_masters')->onDelete('cascade');
            $table->enum('jenis', ['utama', 'sekunder', 'komplikasi'])->default('utama');
            $table->text('keterangan_tambahan')->nullable();
            $table->timestamps();
        });

        Schema::create('tindakan_medis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekam_medis_id')->nullable()->constrained('rekam_medis')->onDelete('cascade');
            $table->foreignId('kunjungan_id')->constrained('kunjungans')->onDelete('cascade');
            $table->foreignId('master_tindakan_id')->constrained('master_tindakans')->onDelete('cascade');
            $table->foreignId('dilakukan_oleh')->nullable()->constrained('users')->onDelete('set null');
            $table->date('tanggal_tindakan');
            $table->time('jam_tindakan');
            $table->integer('jumlah')->default(1);
            $table->text('keterangan')->nullable();
            $table->text('hasil')->nullable();
            $table->timestamps();
        });

        Schema::create('tindakan_keperawatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kunjungan_id')->constrained('kunjungans')->onDelete('cascade');
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('perawat_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('jenis_tindakan', 200);
            $table->text('deskripsi')->nullable();
            $table->datetime('waktu_tindakan');
            $table->text('respons_pasien')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vital_signs');
        Schema::dropIfExists('diagnosas');
        Schema::dropIfExists('tindakan_medis');
        Schema::dropIfExists('tindakan_keperawatans');
    }
};

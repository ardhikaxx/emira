<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('no_rm')->unique();
            $table->string('nik')->unique();
            $table->string('nama_lengkap');
            $table->string('nama_panggilan')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O', 'tidak_diketahui'])->nullable();
            $table->enum('rhesus', ['+', '-', 'tidak_diketahui'])->nullable();
            $table->string('agama')->nullable();
            $table->enum('status_pernikahan', ['belum_menikah', 'menikah', 'cerai_hidup', 'cerai_mati'])->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('no_hp_darurat')->nullable();
            $table->string('nama_kontak_darurat')->nullable();
            $table->string('hubungan_kontak_darurat')->nullable();
            $table->string('email')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten_kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('foto')->nullable();
            $table->enum('jenis_pembayaran', ['umum', 'bpjs'])->default('umum');
            $table->string('no_bpjs')->nullable();
            $table->text('catatan_alergi')->nullable();
            $table->text('catatan_khusus')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('antrians', function (Blueprint $table) {
            $table->id();
            $table->string('kode_antrian', 20);
            $table->integer('no_urut');
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('poli_id')->constrained('polis')->onDelete('cascade');
            $table->foreignId('dokter_id')->constrained('dokters')->onDelete('cascade');
            $table->date('tanggal');
            $table->enum('sumber', ['loket', 'online'])->default('loket');
            $table->enum('status', ['menunggu', 'dipanggil', 'dalam_pelayanan', 'selesai', 'tidak_hadir'])->default('menunggu');
            $table->timestamp('jam_daftar');
            $table->timestamp('jam_dipanggil')->nullable();
            $table->timestamp('jam_selesai')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antrians');
    }
};

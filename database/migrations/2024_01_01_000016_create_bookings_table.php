<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('kode_booking', 30)->unique();
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('poli_id')->constrained('polis')->onDelete('cascade');
            $table->foreignId('dokter_id')->constrained('dokters')->onDelete('cascade');
            $table->foreignId('jadwal_dokter_id')->constrained('jadwal_dokters')->onDelete('cascade');
            $table->date('tanggal_booking');
            $table->time('jam_booking');
            $table->enum('jenis_pembayaran', ['umum', 'bpjs'])->default('umum');
            $table->string('no_bpjs')->nullable();
            $table->text('keluhan')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->foreignId('antrian_id')->nullable()->constrained('antrians')->onDelete('set null');
            $table->text('catatan_pembatalan')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();

            $table->index(['tanggal_booking', 'status']);
            $table->index(['pasien_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

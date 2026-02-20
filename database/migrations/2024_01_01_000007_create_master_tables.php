<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('icd10_masters', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama_penyakit_indonesia');
            $table->string('nama_penyakit_inggris')->nullable();
            $table->string('kategori')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('master_tindakans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tindakan')->unique();
            $table->string('nama_tindakan');
            $table->string('kategori')->nullable();
            $table->text('keterangan')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->enum('group', ['umum', 'tampilan', 'cetak']);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('icd10_masters');
        Schema::dropIfExists('master_tindakans');
        Schema::dropIfExists('pengaturans');
    }
};

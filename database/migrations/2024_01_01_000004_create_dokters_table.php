<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nip')->nullable();
            $table->string('no_sip')->nullable();
            $table->string('no_str')->nullable();
            $table->string('gelar_depan')->nullable();
            $table->string('nama_lengkap');
            $table->string('gelar_belakang')->nullable();
            $table->string('spesialisasi')->nullable();
            $table->foreignId('poli_id')->nullable()->constrained('polis')->onDelete('set null');
            $table->string('no_hp')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};

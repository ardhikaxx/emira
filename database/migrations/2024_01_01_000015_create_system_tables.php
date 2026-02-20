<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('action', ['login', 'logout', 'create', 'update', 'delete', 'view', 'print']);
            $table->string('module', 100)->nullable();
            $table->unsignedBigInteger('referensi_id')->nullable();
            $table->string('referensi_type', 100)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('ip_address', 50)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('judul', 200);
            $table->text('pesan')->nullable();
            $table->enum('jenis', ['info', 'sukses', 'peringatan', 'bahaya'])->default('info');
            $table->boolean('is_read')->default(false);
            $table->string('link', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
        Schema::dropIfExists('activity_logs');
    }
};

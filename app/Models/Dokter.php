<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dokter extends Model
{
    protected $fillable = [
        'user_id', 'nip', 'no_sip', 'no_str', 'gelar_depan', 'nama_lengkap',
        'gelar_belakang', 'spesialisasi', 'poli_id', 'no_hp', 'foto', 'is_active'
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function poli(): BelongsTo
    {
        return $this->belongsTo(Poli::class);
    }

    public function jadwalDokters(): HasMany
    {
        return $this->hasMany(JadwalDokter::class);
    }

    public function antrians(): HasMany
    {
        return $this->hasMany(Antrian::class);
    }

    public function kunjungan(): HasMany
    {
        return $this->hasMany(Kunjungan::class);
    }

    public function rekamMedis(): HasMany
    {
        return $this->hasMany(RekamMedis::class);
    }

    public function getNamaLengkapWithGelarAttribute(): string
    {
        return trim(($this->gelar_depan ? $this->gelar_depan . ' ' : '') . $this->nama_lengkap . ($this->gelar_belakang ? ', ' . $this->gelar_belakang : ''));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poli extends Model
{
    protected $fillable = ['kode_poli', 'nama_poli', 'deskripsi', 'lantai', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function dokters(): HasMany
    {
        return $this->hasMany(Dokter::class);
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
}

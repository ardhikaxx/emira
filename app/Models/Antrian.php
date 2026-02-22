<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Antrian extends Model
{
    protected $fillable = ['kode_antrian', 'no_urut', 'pasien_id', 'poli_id', 'dokter_id', 'tanggal', 'sumber', 'status', 'jam_daftar', 'jam_dipanggil', 'jam_selesai'];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'jam_daftar' => 'datetime',
            'jam_dipanggil' => 'datetime',
            'jam_selesai' => 'datetime',
        ];
    }

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }

    public function poli(): BelongsTo
    {
        return $this->belongsTo(Poli::class);
    }

    public function dokter(): BelongsTo
    {
        return $this->belongsTo(Dokter::class);
    }

    public function kunjungan(): HasMany
    {
        return $this->hasMany(Kunjungan::class);
    }

    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}

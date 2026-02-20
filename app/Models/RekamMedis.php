<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class RekamMedis extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'no_rm_kunjungan', 'kunjungan_id', 'pasien_id', 'dokter_id', 'tanggal_periksa',
        'anamnesis', 'riwayat_penyakit_dahulu', 'riwayat_penyakit_keluarga',
        'riwayat_alergi', 'riwayat_obat_rutin', 'catatan_dokter', 'rencana_tindak_lanjut'
    ];

    protected function casts(): array
    {
        return ['tanggal_periksa' => 'datetime'];
    }

    public function kunjungan(): BelongsTo
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter(): BelongsTo
    {
        return $this->belongsTo(Dokter::class);
    }

    public function diagnosas(): HasMany
    {
        return $this->hasMany(Diagnosa::class);
    }

    public function tindakanMedis(): HasMany
    {
        return $this->hasMany(TindakanMedis::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratRujukan extends Model
{
    protected $fillable = [
        'no_surat', 'kunjungan_id', 'pasien_id', 'dokter_id', 'icd10_id',
        'tujuan_fasilitas', 'dokter_tujuan', 'spesialisasi_tujuan',
        'anamnesis_singkat', 'terapi_diberikan', 'alasan_rujukan', 'jenis_rujukan', 'tanggal_surat'
    ];

    protected function casts(): array
    {
        return ['tanggal_surat' => 'date'];
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

    public function icd10(): BelongsTo
    {
        return $this->belongsTo(Icd10Master::class, 'icd10_id');
    }
}

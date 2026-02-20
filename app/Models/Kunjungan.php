<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kunjungan extends Model
{
    protected $fillable = [
        'no_kunjungan', 'pasien_id', 'dokter_id', 'poli_id', 'antrian_id',
        'tanggal_kunjungan', 'jam_datang', 'jam_dilayani', 'jam_selesai',
        'jenis_kunjungan', 'jenis_pembayaran', 'no_bpjs_kunjungan', 'keluhan_utama',
        'status', 'catatan_pendaftaran', 'registered_by'
    ];

    protected function casts(): array
    {
        return [
            'tanggal_kunjungan' => 'date',
            'jam_datang' => 'datetime:H:i',
            'jam_dilayani' => 'datetime:H:i',
            'jam_selesai' => 'datetime:H:i',
        ];
    }

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter(): BelongsTo
    {
        return $this->belongsTo(Dokter::class);
    }

    public function poli(): BelongsTo
    {
        return $this->belongsTo(Poli::class);
    }

    public function antrian(): BelongsTo
    {
        return $this->belongsTo(Antrian::class);
    }

    public function registeredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    public function rekamMedis(): HasOne
    {
        return $this->hasOne(RekamMedis::class);
    }

    public function vitalSigns(): HasMany
    {
        return $this->hasMany(VitalSign::class);
    }

    public function tindakanMedis(): HasMany
    {
        return $this->hasMany(TindakanMedis::class);
    }

    public function tindakanKeperawatans(): HasMany
    {
        return $this->hasMany(TindakanKeperawatan::class);
    }

    public function rawatInap(): HasOne
    {
        return $this->hasOne(RawatInap::class);
    }

    public function suratRujukans(): HasMany
    {
        return $this->hasMany(SuratRujukan::class);
    }

    public function suratKeteranganSakits(): HasMany
    {
        return $this->hasMany(SuratKeteranganSakit::class);
    }

    public function suratKeteranganSehats(): HasMany
    {
        return $this->hasMany(SuratKeteranganSehat::class);
    }
}

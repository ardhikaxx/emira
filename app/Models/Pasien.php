<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pasien extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'no_rm', 'nik', 'nama_lengkap', 'nama_panggilan', 'tempat_lahir', 'tanggal_lahir',
        'jenis_kelamin', 'golongan_darah', 'rhesus', 'agama', 'status_pernikahan',
        'pendidikan', 'pekerjaan', 'no_hp', 'no_hp_darurat', 'nama_kontak_darurat',
        'hubungan_kontak_darurat', 'email', 'alamat', 'kelurahan', 'kecamatan',
        'kabupaten_kota', 'provinsi', 'kode_pos', 'foto', 'jenis_pembayaran', 'no_bpjs',
        'catatan_alergi', 'catatan_khusus', 'is_active'
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'is_active' => 'boolean',
        ];
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

    public function vitalSigns(): HasMany
    {
        return $this->hasMany(VitalSign::class);
    }

    public function tindakanKeperawatans(): HasMany
    {
        return $this->hasMany(TindakanKeperawatan::class);
    }

    public function rawatInaps(): HasMany
    {
        return $this->hasMany(RawatInap::class);
    }

    public function getUmurAttribute(): int
    {
        if (!$this->tanggal_lahir) return 0;
        return now()->diffInYears($this->tanggal_lahir);
    }
}

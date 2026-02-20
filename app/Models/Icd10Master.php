<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Icd10Master extends Model
{
    protected $fillable = ['kode', 'nama_penyakit_indonesia', 'nama_penyakit_inggris', 'kategori', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function diagnosas(): HasMany
    {
        return $this->hasMany(Diagnosa::class);
    }

    public function suratRujukans(): HasMany
    {
        return $this->hasMany(SuratRujukan::class);
    }
}

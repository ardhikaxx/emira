<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ruangan extends Model
{
    protected $fillable = ['kode_ruangan', 'nama_ruangan', 'jenis', 'kapasitas', 'lantai', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function rawatInaps(): HasMany
    {
        return $this->hasMany(RawatInap::class);
    }
}

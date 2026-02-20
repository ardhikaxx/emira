<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterTindakan extends Model
{
    protected $fillable = ['kode_tindakan', 'nama_tindakan', 'kategori', 'keterangan', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function tindakanMedis(): HasMany
    {
        return $this->hasMany(TindakanMedis::class);
    }
}

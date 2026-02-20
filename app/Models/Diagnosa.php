<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Diagnosa extends Model
{
    protected $fillable = ['rekam_medis_id', 'icd10_id', 'jenis', 'keterangan_tambahan'];

    public function rekamMedis(): BelongsTo
    {
        return $this->belongsTo(RekamMedis::class);
    }

    public function icd10(): BelongsTo
    {
        return $this->belongsTo(Icd10Master::class, 'icd10_id');
    }
}

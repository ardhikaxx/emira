<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerkembanganPasien extends Model
{
    protected $fillable = [
        'rawat_inap_id', 'pasien_id', 'tanggal', 'jam',
        'soap_subjective', 'soap_objective', 'soap_assessment', 'soap_plan', 'dicatat_oleh'
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'jam' => 'datetime:H:i',
        ];
    }

    public function rawatInap(): BelongsTo
    {
        return $this->belongsTo(RawatInap::class);
    }

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dicatatOleh(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dicatat_oleh');
    }
}

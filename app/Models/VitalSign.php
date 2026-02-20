<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VitalSign extends Model
{
    protected $fillable = [
        'kunjungan_id', 'pasien_id', 'tekanan_darah_sistol', 'tekanan_darah_diastol',
        'nadi', 'pernapasan', 'suhu', 'saturasi_oksigen', 'berat_badan', 'tinggi_badan',
        'bmi', 'lingkar_perut', 'gula_darah_sewaktu', 'kesadaran', 'catatan', 'recorded_by'
    ];

    protected function casts(): array
    {
        return [
            'suhu' => 'decimal:1',
            'saturasi_oksigen' => 'decimal:2',
            'berat_badan' => 'decimal:2',
            'tinggi_badan' => 'decimal:2',
            'bmi' => 'decimal:2',
            'lingkar_perut' => 'decimal:2',
        ];
    }

    public function kunjungan(): BelongsTo
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    public function getTekananDarahAttribute(): string
    {
        return "{$this->tekanan_darah_sistol}/{$this->tekanan_darah_diastol}";
    }
}

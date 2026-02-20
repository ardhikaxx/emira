<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TindakanMedis extends Model
{
    protected $fillable = [
        'rekam_medis_id', 'kunjungan_id', 'master_tindakan_id', 'dilakukan_oleh',
        'tanggal_tindakan', 'jam_tindakan', 'jumlah', 'keterangan', 'hasil'
    ];

    protected function casts(): array
    {
        return [
            'tanggal_tindakan' => 'date',
            'jam_tindakan' => 'datetime:H:i',
        ];
    }

    public function rekamMedis(): BelongsTo
    {
        return $this->belongsTo(RekamMedis::class);
    }

    public function kunjungan(): BelongsTo
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function masterTindakan(): BelongsTo
    {
        return $this->belongsTo(MasterTindakan::class, 'master_tindakan_id');
    }

    public function dilakukanOleh(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dilakukan_oleh');
    }
}

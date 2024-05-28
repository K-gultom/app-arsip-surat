<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class suratMasuk extends Model
{
    use HasFactory;

    /**
     * Get the getPengirim that owns the suratMasuk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getPengirim(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pengirim', 'id');
    }

    /**
     * Get the getPenerima that owns the suratMasuk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getPenerima(): BelongsTo
    {
        return $this->belongsTo(bagian::class, 'penerima', 'id');
    }
    
}

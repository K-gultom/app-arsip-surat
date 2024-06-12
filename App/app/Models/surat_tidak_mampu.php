<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class surat_tidak_mampu extends Model
{
    use HasFactory;

    /**
     * Get the getUser that owns the surat_tidak_mampu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tanda_tangan', 'id');
    }
}

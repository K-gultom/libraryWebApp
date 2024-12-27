<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class keranjang extends Model
{
    use HasFactory;

    
// getBookCategory

    /**
     * Get the user that owns the keranjang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getBook(): BelongsTo
    {
        return $this->belongsTo(book::class, 'id_buku', 'id');
    }
}

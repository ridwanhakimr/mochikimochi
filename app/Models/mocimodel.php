<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class mocimodel extends Model
{
    protected $table = 'moci';

    protected $fillable = ['nama', 'gambar', 'harga', 'deskripsi', 'stok', 'updated_by','created_at', 'updated_at'];

    /**
     * Mendapatkan user yang terakhir kali mengubah data.
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
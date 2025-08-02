<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mocimodel extends Model
{
    protected $table = 'moci';

    protected $fillable = ['nama', 'gambar', 'harga', 'deskripsi', 'stok'];
}

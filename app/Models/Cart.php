<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $guarded = [];
    use HasFactory;

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}

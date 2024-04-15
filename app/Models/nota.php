<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nota extends Model
{

    use HasFactory;
    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

}

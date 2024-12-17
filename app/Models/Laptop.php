<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'masuk_id', 'id');
    }
}
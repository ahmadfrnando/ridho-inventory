<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function barangkeluar()
    // {
    //     return $this->hasOne(BarangKeluar::class, 'masuk_id', 'id');
    // }

    public function barangkeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'masuk_id', 'id');
    }

    public function laptop()
    {
        return $this->hasOne(Laptop::class, 'masuk_id', 'id');
    }
}

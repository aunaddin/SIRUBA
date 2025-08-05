<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'kapasitas', 'lokasi'];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}


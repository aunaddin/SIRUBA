<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    protected $table = 'bidangs'; // ✅ pastikan plural
    protected $fillable = ['nama'];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
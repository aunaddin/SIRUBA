<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';

    protected $fillable = [
        'bidang_id', 'bidang_manual', 'ruang_id', 'tanggal',
        'jam_mulai', 'jam_selesai', 'nama_acara',
        'jumlah_peserta', 'penanggung_jawab', 'keterangan', 'status'
    ];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class,'bidang_id');
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

}


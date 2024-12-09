<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengaduanLangsung extends Model
{
    use HasFactory;
    // Menentukan nama tabel secara eksplisit
    protected $table = 'pengaduan_langsung';

    // Menentukan field yang bisa diisi secara mass assignment
    protected $fillable = [
        'nama',
        'no_hp',
        'email',
        'surat_permohonan_pengajuan',
        'ktp',
        'bukti_pengaduan',
        'status',
    ];
}

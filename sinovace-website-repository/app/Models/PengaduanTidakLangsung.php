<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengaduanTidakLangsung extends Model
{
    use HasFactory;
    // Menentukan nama tabel secara eksplisit
    protected $table = 'pengaduan_tidak_langsung';

    // Menentukan field yang bisa diisi secara mass assignment
    protected $fillable = [
        'nama',
        'no_hp',
        'email',
        'bukti_pengaduan',
        'detail_pengaduan',
        'status',
    ];
}

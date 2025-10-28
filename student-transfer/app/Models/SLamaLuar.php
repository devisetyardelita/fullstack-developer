<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SLamaLuar extends Model
{
    use HasFactory;
    use Notifiable;
    // Menentukan nama tabel secara eksplisit
    protected $table = 'slama_luar';

    // Menentukan field yang bisa diisi secara mass assignment
    protected $fillable = [
        'school_slama_id',
        'school_sbaru_name',
        'nama_siswa',
        'nisn',
        'kelas',
        'jenjang',
        'kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'nama_ortu',
        'alamat_ortu',
        'kelurahan',
        'kecamatan',
        'kota',
        'provinsi',
        'alasan',
        'no_hp',
        'email',
        'pesan',
        'surat_permohonan',
        'surat_pernyataan',
        'surat_sbaru',
        'output',
        'status',
        'tipe',
    ];



    public function schoolAsal()
    {
        return $this->belongsTo(School::class, 'school_slama_id');
    }

    // public function schoolTujuan()
    // {
    //     return $this->belongsTo(School::class, 'school_sbaru_id');
    // }

    // public function getNamaSchoolTujuanAttribute()
    // {
    //     if ($this->school_sbaru_id == 999) {
    //         return $this->school_sbaru_lainnya;
    //     }

    //     return $this->schoolTujuan->name ?? '-';
    // }
}

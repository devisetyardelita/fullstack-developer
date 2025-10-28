<?php

namespace App\Models;

use App\Models\KuotaKelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class School extends Model
{
    use HasFactory;
    
    protected $table = 'schools';

    protected $fillable = 
    [
        'nama_sekolah', 
        'jenjang', 
        'status', 
        'kuota', 
        'akreditasi', 
        'is_active', 
        'kelurahan', 
        'kecamatan', 
        'kota', 
        'provinsi', 
        'alamat', 
        'latitude', 
        'longitude', 
        'zoom_level', 
        'email', 
        'no_telp'
    ];

    public function sbaru()
    {
        return $this->hasMany(SBaru::class);
    }

    public function slama()
    {
        return $this->hasMany(SLama::class);
    }
    public function kuotaKelas()
    {
        return $this->hasMany(KuotaKelas::class, 'school_id');
    }
    public function getTotalSisaKuotaAttribute()
    {
        return $this->kuotaKelas()->sum(function ($kelas) {
            return $kelas->sisa_kuota;
        });
    }
    
}

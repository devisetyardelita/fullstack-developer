<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KuotaKelas extends Model
{
    use HasFactory;
    
    protected $table = 'school_class_quotas';

    protected $fillable = 
    [
        'school_id', 
        'kelas',  
        'kuota',
        'kuota_terpakai',
        'sisa_kuota',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
    
    public function getSisaKuotaAttribute()
    {
        return $this->kuota - $this->kuota_terpakai;
    }

    // Metode untuk menambah atau mengurangi kuota terpakai
    public function updateKuotaTerpakai($jumlahMasuk)
    {
        $this->kuota_terpakai = $jumlahMasuk;
        $this->sisa_kuota = $this->kuota - $jumlahMasuk;
        $this->save();
    }
}

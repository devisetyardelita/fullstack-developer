<?php

namespace App\Models;

use App\Events\KuotaUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MutasiDalam extends Model
{
    use HasFactory;
    use Notifiable;
    // Nama tabel yang sesuai dengan database
    protected $table = 'lapor_dalam'; 
    
    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'school_slama_id',
        'school_sbaru_id',
        'nama_siswa',
        'nisn',
        'kelas', 
        'jenjang', 
        'kelamin',
        'no_hp',
        'email',
        'pesan',
        'surat_permohonan',
        'surat_pernyataan',
        'surat_slama',
        'surat_sbaru', 
        'output',
        'status',
        'tipe',
    ];

    public function schoolAsal()
    {
        return $this->belongsTo(School::class, 'school_slama_id');
    }

    public function schoolTujuan()
    {
        return $this->belongsTo(School::class, 'school_sbaru_id');
    }

    public function getNamaSchoolTujuanAttribute()
    {
        if ($this->school_sbaru_id == 999) {
            return $this->school_sbaru_lainnya;
        }

        return $this->schoolTujuan->name ?? '-';
    }
    protected static function boot()
    {
        parent::boot();

        static::updated(function ($laporMutasi) {
            if ($laporMutasi->status === 'Selesai') {
                // Ambil sekolah asal dan tujuan
                $schoolAsal = School::find($laporMutasi->school_slama_id);
                $schoolTujuan = School::find($laporMutasi->school_sbaru_id);

                if ($schoolAsal && $schoolTujuan) {
                    // Update kuota
                    $schoolAsal->kuota += 1;
                    $schoolTujuan->kuota -= 1;

                    $schoolAsal->save();
                    $schoolTujuan->save();

                    // Broadcast event
                    broadcast(new KuotaUpdated(
                        $schoolAsal->id,
                        $schoolAsal->kuota,
                        $schoolTujuan->id,
                        $schoolTujuan->kuota
                    ));
                }
            }
        });
    }
}

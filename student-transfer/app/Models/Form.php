<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',        // Nama layanan
        'email', // Deskripsi layanan
        'phone',
        'document',
        'service_id',
    ];
    
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}

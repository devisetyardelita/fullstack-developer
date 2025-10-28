<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    
    protected $table = 'services';

    protected $fillable = [
        'name',        // Nama layanan
        'description', // Deskripsi layanan
    ];

    public function forms()
    {
        return $this->hasMany(Form::class);
    }

}

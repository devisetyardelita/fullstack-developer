<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MutasiGabungan
{
    public $id;
    public $nama_siswa;
    public $jenjang;
    public $nama_sekolah;
    public $tipe;
    public $jenis;
    public $status;
    public $created_at;

    public function __construct($attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->$key = $value;
        }
    }
}

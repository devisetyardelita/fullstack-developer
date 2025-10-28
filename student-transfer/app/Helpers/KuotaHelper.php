<?php

namespace App\Helpers;

use App\Models\KuotaKelas;
use App\Models\School;

class KuotaHelper
{
    public static function updateTotalKuotaSekolah($schoolId)
    {
        $totalSisa = KuotaKelas::where('school_id', $schoolId)->sum('sisa_kuota');

        School::where('id', $schoolId)->update([
            'kuota' => $totalSisa
        ]);
    }
}

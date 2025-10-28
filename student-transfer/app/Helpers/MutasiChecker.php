<?php

namespace App\Helpers;

use App\Models\MutasiDalam;
use App\Models\MutasiLuar;
use App\Models\SBaru;
use App\Models\SBaruLuar;
use App\Models\SLama;
use App\Models\SLamaLuar;

class MutasiChecker
{
    // public static function siswaPunyaPengajuanAktif($nisn, $jenis)
    // {
    //     switch ($jenis) {
    //         case 'sbaru':
    //             $pengajuan = SBaru::where('nisn', $nisn)->whereNotIn('status', ['Diterima', 'Ditolak']);
    //             break;
    //         case 'sbaru_luar':
    //             $pengajuan = SBaruLuar::where('nisn', $nisn)->whereNotIn('status', ['Diterima', 'Ditolak']);
    //             break;
    //         case 'slama':
    //             $pengajuan = SLama::where('nisn', $nisn)->whereNotIn('status', ['Diterima', 'Ditolak']);
    //             break;
    //         case 'slama_luar':
    //             $pengajuan = SLamaLuar::where('nisn', $nisn)->whereNotIn('status', ['Diterima', 'Ditolak']);
    //             break;
    //         case 'mutasi_dalam':
    //             $pengajuan = MutasiDalam::where('nisn', $nisn)->whereNotIn('status', ['Diterima', 'Ditolak']);
    //             break;
    //         case 'mutasi_luar':
    //             $pengajuan = MutasiLuar::where('nisn', $nisn)->whereNotIn('status', ['Diterima', 'Ditolak']);
    //             break;
    //         default:
    //             return false;
    //     }

    //     return $pengajuan->exists();
    // }
    // public static function siswaPunyaPengajuanAktif($nisn, $layanan)
    // {
    //     switch ($layanan) {
    //         case 'sbaru':
    //             return SBaru::where('nisn', $nisn)
    //                         ->where('status', ['Diterima', 'Diproses'])
    //                         ->exists();
    //         case 'sbaru_luar':
    //             return SBaruLuar::where('nisn', $nisn)
    //                             ->where('status', ['Diterima', 'Diproses'])
    //                             ->exists();
    //         case 'slama':
    //             return SLama::where('nisn', $nisn)
    //                         ->where('status', ['Diterima', 'Diproses'])
    //                         ->exists();
    //         case 'slama_luar':
    //             return SLamaLuar::where('nisn', $nisn)
    //                              ->where('status', ['Diterima', 'Diproses'])
    //                              ->exists();
    //         case 'lapor_dalam':
    //             return MutasiDalam::where('nisn', $nisn)
    //                                ->where('status', ['Diterima', 'Diproses'])
    //                                ->exists();
    //         case 'lapor_luar':
    //             return MutasiLuar::where('nisn', $nisn)
    //                               ->where('status', ['Diterima', 'Diproses'])
    //                               ->exists();
    //         default:
    //             return false;
    //     }
    // }
    public static function siswaPunyaPengajuanAktif($nisn, $layanan)
    {
        switch ($layanan) {
            // Gabungkan sbaru dan sbaru_luar
            case 'sbaru':
            case 'sbaru_luar':
                $querySbaru = SBaru::where('nisn', $nisn)
                                ->whereIn('status', ['Diterima', 'Diproses']);
                $querySbaruLuar = SBaruLuar::where('nisn', $nisn)
                                        ->whereIn('status', ['Diterima', 'Diproses']);

                // Jika ada pengajuan yang aktif di salah satu table
                if ($querySbaru->exists() || $querySbaruLuar->exists()) {
                    return true;
                }
                break;

            // Gabungkan slama dan slama_luar
            case 'slama':
            case 'slama_luar':
                $querySlama = SLama::where('nisn', $nisn)
                                ->whereIn('status', ['Diterima', 'Diproses']);
                $querySlamaLuar = SLamaLuar::where('nisn', $nisn)
                                        ->whereIn('status', ['Diterima', 'Diproses']);

                // Jika ada pengajuan yang aktif di salah satu table
                if ($querySlama->exists() || $querySlamaLuar->exists()) {
                    return true;
                }
                break;

            // Gabungkan lapor_dalam dan lapor_luar
            case 'lapor_dalam':
            case 'lapor_luar':
                $queryLaporDalam = MutasiDalam::where('nisn', $nisn)
                                            ->whereIn('status', ['Diterima', 'Diproses']);
                $queryLaporLuar = MutasiLuar::where('nisn', $nisn)
                                            ->whereIn('status', ['Diterima', 'Diproses']);

                // Jika ada pengajuan yang aktif di salah satu table
                if ($queryLaporDalam->exists() || $queryLaporLuar->exists()) {
                    return true;
                }
                break;

            default:
                return false;
        }

        return false;
    }
    public static function pengajuan($nisn, $layanans)
    {
        foreach ($layanans as $layanan) {
            if (self::siswaPunyaPengajuanAktif($nisn, $layanan)) {
                return true;
            }
        }
        return false;
    }
}

<?php

namespace App\Helpers;

class NotificationHelper
{
    public static function getNotificationColor(string $formType): string
    {
        // dd($formType);  // Cek apakah 'formType' yang diterima sudah benar
        return match ($formType) {
            'sbaru', 'sbaru_luar' => 'bg-label-success',
            'slama', 'slama_luar' => 'bg-label-danger ',
            'lapor_dalam', 'lapor_luar' => 'bg-label-info ',
            default => 'bg-label-secondary ',
        };
    }

    public static function getNotificationIcon(string $formType): string
    {
        return match ($formType) {
            'sbaru', 'sbaru_luar' => '📥',
            'slama', 'slama_luar' => '📤',
            'lapor_dalam', 'lapor_luar' => '🔁',
            default => '📄',
        };
    }
    public static function getNotificationLabel(string $formType): string
    {
        return match ($formType) {
            'sbaru', 'sbaru_luar' => 'Mutasi Masuk',
            'slama', 'slama_luar' => 'Mutasi Keluar',
            'lapor_dalam', 'lapor_luar' => 'Mutasi Siswa',
            default => 'Layanan Lain',
        };
    }

}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Helpers\NotificationHelper;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ServicesRequest extends Notification
{
    use Queueable;
    protected $data;
    protected $formType;

    /**
     * Create a new notification instance.
     */
    public function __construct($data, $formType)
    {
        $this->data = $data;
        $this->formType = $formType;  // Jenis formulir (izin penelitian, pengaduan, dll)
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // Untuk email
    public function toMail($notifiable)
    {
        $url = $this->getFormUrl();  // Ambil URL sesuai jenis formulir

        return (new MailMessage)
            ->line('Pengajuan baru telah masuk.')
            ->action('Lihat Pengajuan', $url);
    }
    
    public function toDatabase($notifiable)
    {
        $url = $notifiable->role === 'operator'
            ? url('/operator/' . $notifiable->school_id)
            : url('/admin/' . $this->formType);

        return [
            'message' => NotificationHelper::getNotificationLabel($this->formType)  . ' - Ada pengajuan baru jenjang ' . $this->data['jenjang'] . ' dari ' . $this->data['nama_siswa'],
            'formType' => $this->formType,
            'url' => $url,
            'time' => now()->format('d M Y H:i'),
        ];
    }

    // Menentukan URL berdasarkan jenis formulir
    private function getFormUrl()
    {
        if ($this->formType == 'lapor_dalam' && 'lapor_luar') {
            return url('/admin/mutasi_siswa');
        } elseif ($this->formType == 'sbaru' && 'sbaru_luar') {
            return url('/admin/mutasi_masuk');
        } elseif ($this->formType == 'slama' && 'slama_luar') {
            return url('/admin/mutasi_keluar');
        } 
        return url('/admin');  // Default URL jika jenis formulir tidak dikenali
    }
    

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

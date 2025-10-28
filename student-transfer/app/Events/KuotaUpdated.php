<?php

namespace App\Events;

use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class KuotaUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $schoolId;
    public $kelas;
    public $sisaKuota;

    public function __construct($schoolId, $kelas, $sisaKuota)
    {
        $this->schoolId = $schoolId;
        $this->kelas = $kelas;
        $this->sisaKuota = $sisaKuota;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new Channel('kuota-sekolah');
    }

    public function broadcastAs()
    {
        return 'kuota.updated';
    }
}

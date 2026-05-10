<?php

namespace App\Events;

use App\Models\CarModel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CarModelDeletedEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public string $userName,
        public string $carInfo
    ) {
        \Illuminate\Support\Facades\Log::info("Broadcasting CarModelDeletedEvent: {$carInfo} by {$userName}");
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('car-monitoring'),
        ];
    }
}
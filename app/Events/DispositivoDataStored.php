<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\DispositivoUserData;

class DispositivoDataStored implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(DispositivoUserData $data)
    {
      $this->data = $data;
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
      return [
        'dispositivo' => $this->data->dispositivo_user_id,
        'data' =>
          [
            $this->data->data_1.' '.$this->data->dispositivo->unidad(1),
            $this->data->data_2.' '.$this->data->dispositivo->unidad(2),
            $this->data->data_3.' '.$this->data->dispositivo->unidad(3),
          ]
      ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
      return new PrivateChannel('user.'.$this->data->dispositivo->user_id);
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
      return 'data.stored';
    }
}

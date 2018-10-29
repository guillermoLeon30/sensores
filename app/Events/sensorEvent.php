<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class sensorEvent implements ShouldBroadcastNow
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $sensor;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($sensor){
    $this->sensor = $sensor;
  }

  /**
   * Get the channels the event should broadcast on.
   *
   * @return \Illuminate\Broadcasting\Channel|array
   */
  public function broadcastOn(){
    return new Channel('sensor');
  }
}

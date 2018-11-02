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
use Carbon\Carbon;

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

  /**
   * Get the data to broadcast.
   *
   * @return array
   */
  public function broadcastWith(){
    return [
      'equipo'    =>  (int) $this->sensor['equipo'],
      'sensor'    =>  (int) $this->sensor['sensor'],
      'data'      =>  (int) $this->sensor['data'],
      'date_time' =>  Carbon::now()->setTimeZone('America/Lima')->toTimeString()
    ];
  }
}

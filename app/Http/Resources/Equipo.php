<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Sensor;

class Equipo extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request){
    return [
      'id'        =>  $this->id,
      'nombre'    =>  $this->nombre,
      'marca'     =>  $this->marca,
      'modelo'    =>  $this->modelo,
      'sensores'  =>  Sensor::collection($this->whenLoaded('sensores'))
    ];
  }
}

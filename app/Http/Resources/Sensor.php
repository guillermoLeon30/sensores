<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Sensor extends JsonResource
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
      'tipo'      =>  $this->tipo->valor,
      'unidad'    =>  $this->unidad->valor,
      'ubicacion' =>  $this->ubicacion,
      'datos'     =>  [],
      'fecha'     =>  []
    ];
  }
}

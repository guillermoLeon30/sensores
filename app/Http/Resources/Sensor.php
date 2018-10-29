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
      'id'      =>  $this->id,
      'tipo'    =>  $this->tipo->valor,
      'unidad'  =>  $this->unidad->valor,
      'datos'   =>  [25, 26, 27, 28, 30, 29, 40, 35],
      'fecha'   =>  ['22:08:10', '22:08:15', '22:08:20', '22:08:25', '22:08:30', '22:08:35', '22:08:40', '22:08:45']
    ];
  }
}

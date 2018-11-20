<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Sensor extends JsonResource
{
  private $datos;
  private $fecha;

  function __construct($resource, $datos = [], $fecha = []){
    if (!is_array($datos) || !is_array($fecha)) {
      $this->datos = [];
      $this->fecha = [];
    } else {
      $this->datos = $datos;
      $this->fecha = $fecha;
    }

    parent::__construct($resource);
  }

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
      'datos'     =>  $this->datos,
      'fecha'     =>  $this->fecha
    ];
  }
}

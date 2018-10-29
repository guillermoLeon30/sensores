<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
  protected $table = 'sensores';
  public $timestamps = false;
  protected $fillable = [
    'equipo_id',
    'tipo_sensor_id',
    'unidad_id',
    'marca',
    'modelo',
    'serie',
    'ubicacion',
    'descripcion',
    'alarma_maxima',
    'alarma_minima'
  ];
  
  //----------------------------------RELACIONES----------------------------------
  public function tipo(){
    return $this->belongsTo('App\Models\Categoria', 'tipo_sensor_id');
  }

  public function unidad(){
    return $this->belongsTo('App\Models\Categoria', 'unidad_id');
  }

  public function estado(){
    return $this->belongsTo('App\Models\Categoria', 'estado_id');
  }

  //------------------------------------ALCANCES----------------------------------
  public function scopeBuscar($query, $buscar){
    return $query->where('ubicacion', 'like', '%'.$buscar.'%')
                 ->orWhere('marca', 'like', '%'.$buscar.'%')
                 ->orWhere('modelo', 'like', '%'.$buscar.'%')
                 ->orWhere('descripcion', 'like', '%'.$buscar.'%');
  }

  //----------------------------------METODOS----------------------------------
   /**
   * Funcion que crea una nueva empresa.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \App\Models\Sensor
   */
  public static function crear($request){
    $request->validate([
      'tipo_sensor_id'  => 'required|integer|max:4294967295',
      'unidad_id'       => 'required|integer|max:4294967295',
      'marca'           => 'required|string|max:45',
      'modelo'          => 'required|string|max:45',
      'serie'           => 'required|string|max:45',
      'ubicacion'       => 'required|string|max:100',
      'descripcion'     => 'required|string|max:100',
      'alarma_maxima'   => 'required|string|max:100',
      'alarma_minima'   => 'required|string|max:100',
    ]);

    $sensor = new Sensor($request->all());
    $sensor->estado_id = Categoria::idEstado('activo');
    $sensor->save();

    $page = $request->page;
    $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
    
    return Sensor::where('equipo_id', $sensor->equipo_id)
                 ->buscar($filtro)
                 ->with(['tipo', 'unidad', 'estado']);
  }
}

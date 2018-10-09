<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
  public $timestamps = false;
  protected $fillable = ['nombre', 'marca', 'modelo', 'imagen', 'descripcion', 'empresa_id'];

  //----------------------------------RELACIONES----------------------------------
  public function sensores(){
    return $this->hasMany('App\Models\Sensor');
  }

  //------------------------------------ALCANCES----------------------------------
  public function scopeBuscar($query, $buscar){
    return $query->where('nombre', 'like', '%'.$buscar.'%')
                 ->where('modelo', 'like', '%'.$buscar.'%');
  }

  //--------------------------------------METODOS-----------------------------------
  /**
   * Funcion que crea una nueva empresa.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \App\Models\Equipo
   */
  public static function crear($request){
    $request->validate([
      'nombre'      => 'required|string|max:45',
      'marca'       => 'required|string|max:45',
      'modelo'      => 'required|string|max:45',
      'imagen'      => 'image|nullable',
      'descripcion' => 'string|max:200',
    ]);

    Equipo::create($request->all());

    $page = $request->page;
    $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
    
    return Equipo::buscar($filtro);
  }

  /**
   * Retorna una lista de sensores con todas sus relaciones
   *
   * @param  
   * @return \App\User
   */
  public function listaSensores(){
    return $this->sensores()->with(['tipo', 'unidad', 'estado']);
  }
}

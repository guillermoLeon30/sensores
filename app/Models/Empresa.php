<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Empresa extends Model
{
  public $timestamps = false;
  protected $fillable = ['nombre', 'direccion', 'tipo_documento_id', 'documento'];

  //----------------------------------RELACIONES----------------------------------
  public function tipoDocumento(){
    return $this->belongsTo('App\Models\Categoria', 'tipo_documento_id');
  }

  public function estado(){
    return $this->belongsTo('App\Models\Categoria', 'estado_id');
  }

  public function usuarios(){
    return $this->hasMany('App\User');
  }

  public function equipos(){
    return $this->hasMany('App\Models\Equipo');
  }

  //------------------------------------ALCANCES----------------------------------
  public function scopeBuscar($query, $buscar){
    return $query->where('nombre', 'like', '%'.$buscar.'%');
  }

  //--------------------------------------METODOS-----------------------------------
  /**
   * Activa una empresa para que tenga el servicio.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return mix
   */
  public function activar($request){
    $estado = Categoria::where('categoria', 'estado')
                       ->where('valor', 'activo')
                       ->get()
                       ->first();
    
    return $this->cambiarEstado($estado, $request);
  }

  /**
   * Desactiva una empresa para que no tenga el servicio.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return mix
   */
  public function desactivar($request){
    $estado = Categoria::where('categoria', 'estado')
                       ->where('valor', 'inactivo')
                       ->get()
                       ->first();
        
    return $this->cambiarEstado($estado, $request);
  }

  /**
   * Funcion que cambia el estado de una empresa.
   *
   * @param  \App\Models\categoria     $estado
   * @param  \Illuminate\Http\Request  $request
   * @return mix
   */
  private function cambiarEstado($estado, $request){
    $this->estado_id = $estado->id;
    $this->save();

    $page = $request->page;
    $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
    
    return Empresa::buscar($filtro)->with(['tipoDocumento', 'estado']);
  }

  /**
   * Funcion que crea una nueva empresa.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \App\Models\Empresa
   */
  public static function crear($request){
    $request->validate([
      'nombre'            => 'required|string|max:45',
      'direccion'         => 'required|string|max:100',
      'tipo_documento_id' => 'required|integer|max:4294967295',
      'documento'         => 'required|string|max:45',
    ]);

    $empresa = new Empresa($request->all());
    $empresa->estado_id = Categoria::idEstado('activo');
    $empresa->save();

    $page = $request->page;
    $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
    
    return Empresa::buscar($filtro)->with(['tipoDocumento', 'estado']);
  }

  /**
   * Retorna una lista de usuarios con todas sus relaciones
   *
   * @param  
   * @return \App\User
   */
  public function listaUsuarios(){
    return $this->usuarios()->with(['tipoDocumento', 'estado', 'rol']);
  }
}

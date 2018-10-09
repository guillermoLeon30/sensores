<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
  public $timestamps = false;
  protected $fillable = ['categoria', 'valor'];

  //------------------------------------ALCANCES----------------------------------
  public function scopeBuscar($query, $buscar){
    return $query->where('categoria', 'like', '%'.$buscar.'%')
                 ->orWhere('valor', 'like', '%'.$buscar.'%');
  }

  //--------------------------------------METODOS-----------------------------------
  /**
   * Activa el estado de la categoria para que sea escogible.
   *
   * @param  
   * @return 
   */
  public function activar(){
    $this->estado = 1;
    $this->save();
  }

  /**
   * Desactiva el estado de la categoria para que no sea escogible.
   *
   * @param  
   * @return 
   */
  public function desactivar(){
    $this->estado = 2;
    $this->save();
  }

  /**
   * Guarda la categoria y devuelve un nuevo listado de categorias
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \App\Models\Categoria
   */
  public static function guardar($request){
    $request->validate([
      'categoria' => 'required|string|max:45',
      'valor'     => 'required|string|max:45',
    ]);

    Categoria::create($request->all());

    $page = $request->page;
    $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';

    return Categoria::buscar($filtro)->paginate(5);
  }

  /**
   * Devuelve una lista segun la categoria ingresada.
   *
   * @param  
   * @return \App\Models\Categoria
   */
  public static function lista($categoria){
    return Categoria::where('categoria', $categoria)
                    ->where('estado', 'activo');
  }

  /**
   * Devuelve el id del estado activo o inactivo de las categorias.
   *
   * @param  String 'activo' | 'inactivo'
   * @return int
   */
  public static function idEstado($estado){
    return Categoria::where('categoria', 'estado')
                    ->where('valor', $estado)
                    ->get()
                    ->first()
                    ->id;
  }

  /**
   * Devuelve el id de la categoria rol con su valor super administrador.
   *
   * @param  
   * @return int
   */
  public static function idSuperAdmin(){
    return Categoria::where('categoria', 'rol')
                    ->where('valor', 'superAdmin')
                    ->get()
                    ->first()
                    ->id;
  }

}

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
}

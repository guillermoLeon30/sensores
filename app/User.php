<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Categoria;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
  use HasApiTokens, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 
    'email', 
    'password', 
    'rol_id', 
    'estado_id', 
    'empresa_id', 
    'tipo_documento_id', 
    'celular', 
    'documento'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'password', 'remember_token',
  ];

  //----------------------------------RELACIONES----------------------------------
  public function tipoDocumento(){
    return $this->belongsTo('App\Models\Categoria', 'tipo_documento_id');
  }

  public function estado(){
    return $this->belongsTo('App\Models\Categoria', 'estado_id');
  }

  public function rol(){
    return $this->belongsTo('App\Models\Categoria', 'rol_id');
  }
  //------------------------------------ALCANCES----------------------------------
  public function scopeBuscar($query, $buscar){
    return $query->where('name', 'like', '%'.$buscar.'%');
  }

  //--------------------------------------METODOS-----------------------------------
  /**
   * Guarda un nuevo usuario de una empresa
   *
   * @param  \Illuminate\Http\Request  $request
   * @return mix
   */
  public static function crear($request){
    $request->validate([
      'rol_id'            => 'required|integer|max:4294967295',  
      'empresa_id'        => 'required|integer|max:4294967295', 
      'name'              => 'required|string|max:255',
      'email'             => 'required|string|email|max:255|unique:users',
      'password'          => 'required|string|max:255',
      'celular'           => 'string|max:45',
      'tipo_documento_id' => 'required|integer|max:4294967295',
      'documento'         => 'required|string|max:45',
    ]);

    $usuario = new User($request->all());
    $usuario->estado_id = Categoria::idEstado('activo');
    $usuario->password = Hash::make($request->password);
    $usuario->save();

    $page = $request->page;
    $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
    
    return User::buscar($filtro)->where('empresa_id', $request->empresa_id)
                                ->with(['tipoDocumento', 'estado', 'rol']);
  }
}

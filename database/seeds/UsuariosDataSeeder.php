<?php

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Empresa;
use App\User;

class UsuariosDataSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(){
    $tipoDocumentos = $this->tipoDocumentos();
    $id_estado = $this->estadoId();
    $empresas = $this->empresas();
    $roles = $this->roles();

    $usuarios = factory(App\User::class, 50)->make();

    $usuarios->transform(function ($user, $key) 
      use($tipoDocumentos, $id_estado, $empresas, $roles){
      $user->rol_id = rand($roles->min('id'), $roles->max('id'));
      $user->empresa_id = rand($empresas->min('id'), $empresas->max('id'));
      $user->tipo_documento_id = rand($tipoDocumentos->min('id'), $tipoDocumentos->max('id'));
      $user->estado_id = $id_estado;

      return $user;
    });

    User::insert($usuarios->toArray());
  }

  private function tipoDocumentos(){
    return Categoria::where('categoria', 'tipoDocumento')->get();
  }

  private function estadoId(){
    return Categoria::where('categoria', 'estado')
                    ->where('valor', 'activo')
                    ->get()
                    ->first()
                    ->id;
  }

  public function empresas(){
    return Empresa::all();
  }

  public function roles(){
    return Categoria::where('categoria', 'rol')
                    ->where('valor', '<>', 'superAdmin')
                    ->get();
  }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(){
    $tipo_documento_id = DB::table('categorias')->where('categoria', 'tipoDocumento')
                                                ->where('valor', 'cedula')
                                                ->get()
                                                ->first()
                                                ->id;

    $estado_id = DB::table('categorias')->where('categoria', 'estado')
                                        ->where('valor', 'activo')
                                        ->get()
                                        ->first()
                                        ->id;

    $rol_id = DB::table('categorias')->where('categoria', 'rol')
                                     ->where('valor', 'superAdmin')
                                     ->get()
                                     ->first()
                                     ->id;

    $empresa_id = DB::table('empresas')->where('nombre', 'Eloquent')
                                       ->get()
                                       ->first()
                                       ->id;

    DB::table('users')->insert([
      'rol_id'            =>  $rol_id,
      'empresa_id'        =>  $empresa_id,
      'name'              =>  'Guillermo Leon',
      'email'             =>  'gleon@gmail.com',
      'password'          =>  bcrypt('guillermo'),
      'tipo_documento_id' =>  $tipo_documento_id,
      'documento'         =>  '0946545656',
      'estado_id'         =>  $estado_id
    ]);
  }
}

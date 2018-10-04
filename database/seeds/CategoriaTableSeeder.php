<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(){
    DB::table('categorias')->insert([
      [
        'categoria' =>  'rol',
        'valor'     =>  'superAdmin'
      ],
      [
        'categoria' =>  'rol',
        'valor'     =>  'admin'
      ],
      [
        'categoria' =>  'rol',
        'valor'     =>  'operador'
      ],
      [
        'categoria' =>  'tipoDocumento',
        'valor'     =>  'cedula'
      ],
      [
        'categoria' =>  'tipoDocumento',
        'valor'     =>  'ruc'
      ],
      [
        'categoria' =>  'estado',
        'valor'     =>  'activo'
      ],
      [
        'categoria' =>  'estado',
        'valor'     =>  'inactivo'
      ]
    ]);
  }
}

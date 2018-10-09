<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InicializacionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(){
    $this->call([
      CategoriaTableSeeder::class,
      EmpresaTableSeeder::class,
      UsuarioTableSeeder::class,
    ]);
  }
}

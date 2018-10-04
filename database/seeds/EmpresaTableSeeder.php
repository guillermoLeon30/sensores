<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(){
  	$tipo_documento_id = DB::table('categorias')->where('categoria', 'tipoDocumento')
  																							->where('valor', 'ruc')
  																							->get()
                                                ->first()
  																							->id;

  	$estado_id = DB::table('categorias')->where('categoria', 'estado')
  																			->where('valor', 'activo')
  																			->get()
                                        ->first()
  																			->id;

    DB::table('empresas')->insert([
    	[
    		'nombre'						=>	'Eloquent',
    		'direccion'					=>	'Clemente Ballen y Rumichaca',
    		'tipo_documento_id'	=>	$tipo_documento_id,
    		'documento'					=>	'0991243245435',
    		'estado_id'					=>	$estado_id
    	]
    ]);
  }
}

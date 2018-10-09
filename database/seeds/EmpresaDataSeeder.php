<?php

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Empresa;

class EmpresaDataSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(){
  	$tipoDocumentos = $this->tipoDocumentos();
  	$estados = $this->estados();

    $empresas = factory(App\Models\Empresa::class, 30)->make();

    $empresas->transform(function ($empresa, $key) use ($tipoDocumentos, $estados){
    	$empresa->tipo_documento_id = rand($tipoDocumentos->min('id'), $tipoDocumentos->max('id'));
    	$empresa->estado_id = rand($estados->min('id'), $estados->max('id'));

    	return $empresa;
    });

    Empresa::insert($empresas->toArray());
  }

  private function tipoDocumentos(){
  	return Categoria::where('categoria', 'tipoDocumento')->get();
  }

  private function estados(){
  	return Categoria::where('categoria', 'estado')->get();
  }
}

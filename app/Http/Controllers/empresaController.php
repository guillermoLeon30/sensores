<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Categoria;

class empresaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request){
    $page = $request->page;
    $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
    $empresas = Empresa::buscar($filtro)->with(['tipoDocumento', 'estado'])->paginate(5);

    if ($request->ajax()) {
      return response()->json(view('superAdmin.empresa.index.include.tEmpresas',[
        'empresas'  =>  $empresas
      ])->render());
    }

    return view('superAdmin.empresa.index.index', [
      'empresas'        =>  $empresas,
      'tipoDocumentos'  =>  Categoria::lista('tipoDocumentos')->get()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){
    $empresas = Empresa::crear($request)->paginate(5);

    return response()->json(view('superAdmin.empresa.index.include.tEmpresas',[
      'empresas'  =>  $empresas
    ])->render());
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      //
  }

  /**
   * Activa una empresa.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function activar(Request $request){
    $empresa = Empresa::findOrFail($request->idEmpresa);
    $empresas = $empresa->activar($request)->paginate(5);

    return response()->json(view('superAdmin.empresa.index.include.tEmpresas',[
      'empresas'  =>  $empresas
    ])->render());
  }

  /**
   * Desactiva una empresa.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function desactivar(Request $request){
    $empresa = Empresa::findOrFail($request->idEmpresa);
    $empresas = $empresa->desactivar($request)->paginate(5);

    return response()->json(view('superAdmin.empresa.index.include.tEmpresas',[
      'empresas'  =>  $empresas
    ])->render());
  }

  /**
   * Muestra los registros de usuarios y equipos de la empresa.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function registros(Empresa $empresa){
    $usuarios = $empresa->listaUsuarios()->paginate(5);
    $tipoDocumentos = Categoria::lista('tipoDocumento')->get();
    $roles = Categoria::lista('rol')->get();
    $equipos = $empresa->equipos()->paginate(5);

    return view('superAdmin.empresa.registros.index.index', [
      'empresa'         =>  $empresa,
      'usuarios'        =>  $usuarios,
      'tipoDocumentos'  =>  $tipoDocumentos,
      'roles'           =>  $roles,
      'equipos'         =>  $equipos
    ]);
  }
}

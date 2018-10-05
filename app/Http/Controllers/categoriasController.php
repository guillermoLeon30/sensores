<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class categoriasController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request){
    $page = $request->page;
    $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
    $categorias = Categoria::buscar($filtro)->paginate(5);

    if ($request->ajax()) {
      return response()->json(view('superAdmin.categoria.index.include.tCategorias',[
        'categorias'  =>  $categorias
      ])->render());
    }

    return view('superAdmin.categoria.index.index', [
      'categorias'  =>  $categorias
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
    $categorias = Categoria::guardar($request);

    return response()->json(view('superAdmin.categoria.index.include.tCategorias',[
      'categorias'  =>  $categorias
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
   * Activa una categorria
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function activar(Request $request){
    $categoria = Categoria::findOrFail($request->idCategoria);
    $categoria->activar();

    $page = $request->page;
    $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
    $categorias = Categoria::buscar($filtro)->paginate(5);

    return response()->json(view('superAdmin.categoria.index.include.tCategorias',[
      'categorias'  =>  $categorias
    ])->render());
  }

  /**
   * Desactiva una categorria
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function desactivar(Request $request){
    $categoria = Categoria::findOrFail($request->idCategoria);
    $categoria->desactivar();

    $page = $request->page;
    $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
    $categorias = Categoria::buscar($filtro)->paginate(5);

    return response()->json(view('superAdmin.categoria.index.include.tCategorias',[
      'categorias'  =>  $categorias
    ])->render());
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\Categoria;
use App\Http\Resources\Equipo as EquipoResource;
use App\Events\sensorEvent;
use App\Api\Consultas;

class EquipoController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      //
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
    $equipos = Equipo::crear($request)->paginate(5);

    return response()->json(view('superAdmin.empresa.registros.index.include.tEquipos',[
      'equipos'  =>  $equipos
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
   * Se dirige a la vista de sensores.
   *
   * @param  \App\Models\Equipo
   * @return \Illuminate\Http\Response
   */
  public function sensores(Equipo $equipo){
    $sensores = $equipo->listaSensores()->paginate(5);
    $tipos = Categoria::lista('tipo_sensor')->get();
    $unidades = Categoria::lista('unidad')->get();

    return view('superAdmin.empresa.registros.sensor.index.index', [
      'equipo'    =>  $equipo,
      'sensores'  =>  $sensores,
      'tipos'     =>  $tipos,
      'unidades'  =>  $unidades
    ]);
  }

  /**
   * Devuelve un json de los equipos usar with('sensores') si se quiere con los sensores
   *
   * @param  
   * @return \Illuminate\Http\Response\JsonResponse
   */
  public function apiIndex(){
    return EquipoResource::collection(Equipo::with('sensores')->get());
  }


  /**
   * Guarda un dato de un sensor en la influx y hace un evento bradcasting para el scada.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return 
   */
  public function apiStore(Request $request){
    Consultas::guardarInflux($request->data, $request->equipo, $request->sensor);

    event(new sensorEvent($request->all()));
  }

  /**
   * Devuelve los datos del sensor solicitado
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response\JsonResponse
   */
  public function apiDataSensor(Request $request){
    /*$validator = Validator::make($request->all(), [
      'equipo'     => 'required|email',
      'password'  => 'required',
    ]);

    if ($validator->fails())
      return [
        'errores' => $validator->errors()->all()
      ]);*/

    return Consultas::getDataSensor($request);
  }
}

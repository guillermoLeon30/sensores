<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;
use TrayLabs\InfluxDB\Facades\InfluxDB;
use InfluxDB\Point;
use Carbon\Carbon;

class Consultas extends Model
{
  public static function guardarInflux($data, $equipo, $sensor){
    $points = array(
      new Point(
        'sensor',
        (float) $data,
        [],
        [
          'idEquipo'  =>  $equipo,
          'idSensor'  =>  $sensor
        ]
      )
    );    

    return InfluxDB::writePoints($points);
  }

  public static function getDataSensor($request){
    $fechaInicial = Carbon::createFromFormat('Y-m-d H:i:sT', $request->fechaInicial)
                    ->tz('UTC')
                    ->toRfc3339String();

    $fechaFinal = Carbon::createFromFormat('Y-m-d H:i:sT', $request->fechaFinal)
                  ->tz('UTC')
                  ->toRfc3339String();
                  
    $incremento = sprintf('%s%s', $request->incremento, $request->tiempo);
    
    $resultado = InfluxDB::query("
      SELECT mean(\"value\") As value
      FROM sensor 
      WHERE idEquipo = '$request->equipo' AND idSensor = '$request->sensor' AND time >= '$fechaInicial' AND time <= '$fechaFinal'
      Group By time($incremento) fill(none)
      TZ('America/Guayaquil')")->getPoints();

    $fechas = collect($resultado)->map(function ($item, $key){
      sscanf($item['time'], "%d-%d-%dT%d:%d:%d.%s", $anio, $mes, $dia, $hora, $minuto, $segundo, $basura);
      $fecha = Carbon::create($anio, $mes, $dia, $hora, $minuto, $segundo, 'America/Guayaquil');

      return $fecha->format('d/m/Y - H:i:s');
    })->all();

    $datos = array_column($resultado, 'value');

    return [
      'fechas'  =>  $fechas,
      'datos'   =>  $datos
    ];
  }
}

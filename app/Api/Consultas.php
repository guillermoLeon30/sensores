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
    $fechaInicial = sprintf('%sT00:00:00Z', $request->fechaInicial);
    $fechaFinal = sprintf('%sT23:59:59Z', $request->fechaFinal);
    $incremento = sprintf('%s%s', $request->incremento, $request->tiempo);
    
    $resultado = InfluxDB::query("
      SELECT mean(\"value\") As value
      FROM sensor 
      WHERE idEquipo = '$request->equipo' AND idSensor = '$request->sensor' AND time >= '$request->fechaInicial' AND time <= '$request->fechaFinal'
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

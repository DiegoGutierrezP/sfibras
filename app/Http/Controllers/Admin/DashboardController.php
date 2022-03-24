<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getInfoCards(){
        $ocEntregados = DB::select('select fu_obtenerOCEntregados() AS ocEntregados');
        $ocPendientes = DB::select('select fu_obtenerOCPendientes() AS ocPendientes');

        $now = Carbon::now()->toDateString();
        $ingresoTotalMes = DB::select("select fu_obtenerIngresosXMes('$now') AS ingresoTotal");


        return response()->json([
            'res'=>true,
            'data'=>[
                "ocEntregados"=>$ocEntregados[0]->ocEntregados,
                "ocPendientes"=>$ocPendientes[0]->ocPendientes,
                "ingresosTotalMes"=>"S/. ".$ingresoTotalMes[0]->ingresoTotal],
        ]);
    }
    public function getIngresosUltimos4Meses(){
        $now1 = Carbon::now()->toDateString();
        $now2 = Carbon::now()->subMonth(1)->toDateString();
        $now3 = Carbon::now()->subMonth(2)->toDateString();
        $now4 = Carbon::now()->subMonth(3)->toDateString();
        $mes1 = DB::select("select fu_obtenerIngresosXMes('$now1') AS ingresoMes1");
        $mes2 = DB::select("select fu_obtenerIngresosXMes('$now2') AS ingresoMes2");
        $mes3 = DB::select("select fu_obtenerIngresosXMes('$now3') AS ingresoMes3");
        $mes4 = DB::select("select fu_obtenerIngresosXMes('$now4') AS ingresoMes4");

        $now1 = Carbon::createFromFormat('Y-m-d',$now1)->locale('es')->isoFormat('MMMM \d\e\l Y');
        $now2 = Carbon::createFromFormat('Y-m-d',$now2)->locale('es')->isoFormat('MMMM \d\e\l Y');
        $now3 = Carbon::createFromFormat('Y-m-d',$now3)->locale('es')->isoFormat('MMMM \d\e\l Y');
        $now4 = Carbon::createFromFormat('Y-m-d',$now4)->locale('es')->isoFormat('MMMM \d\e\l Y');

        return response()->json([
            'res'=>true,
            'data'=>[
                "labels"=>[
                    $now1,
                    $now2,
                    $now3,
                    $now4
                ],
                "data"=>[
                    $mes1[0]->ingresoMes1,
                    $mes2[0]->ingresoMes2,
                    $mes3[0]->ingresoMes3,
                    $mes4[0]->ingresoMes4
                ]
            ]
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getInfoCards(){
        try{
            $ocEntregados = DB::select('select fu_obtenerOCEntregados() AS ocEntregados');
            $ocPendientes = DB::select('select fu_obtenerOCPendientes() AS ocPendientes');

            $now = Carbon::now()->toDateString();
            $ingresoTotalMes = DB::select("select fu_obtenerIngresosXMes('$now') AS ingresoTotal");
            $pedidosXMes = DB::select("select fu_obtenerPedidosEmitidosXMes('$now') AS pedidosEmitidos");

            return response()->json([
                'res'=>true,
                'data'=>[
                    "ocEntregados"=>$ocEntregados[0]->ocEntregados,
                    "ocPendientes"=>$ocPendientes[0]->ocPendientes,
                    "ingresosTotalMes"=>"S/. ".$ingresoTotalMes[0]->ingresoTotal,
                    "pedidosXMes"=>$pedidosXMes[0]->pedidosEmitidos,
                ]
            ]);

        }catch(Exception $err){
            return response()->json([
                'res'=>false,
                'msg'=>$err->getMessage(),
            ]);
        }


    }
    public function getIngresosUltimos4Meses(){
        try{

            $now1 = Carbon::now()->toDateString();
            $now2 = Carbon::now()->subMonth(1)->toDateString();
            $now3 = Carbon::now()->subMonth(2)->toDateString();
            $now4 = Carbon::now()->subMonth(3)->toDateString();
            $mes1 = DB::select("select fu_obtenerIngresosXMes('$now1') AS ingresoMes1");
            $mes2 = DB::select("select fu_obtenerIngresosXMes('$now2') AS ingresoMes2");
            $mes3 = DB::select("select fu_obtenerIngresosXMes('$now3') AS ingresoMes3");
            $mes4 = DB::select("select fu_obtenerIngresosXMes('$now4') AS ingresoMes4");

            $now1 = Carbon::createFromFormat('Y-m-d',$now1)->locale('es')->isoFormat('MMMM Y');
            $now2 = Carbon::createFromFormat('Y-m-d',$now2)->locale('es')->isoFormat('MMMM Y');
            $now3 = Carbon::createFromFormat('Y-m-d',$now3)->locale('es')->isoFormat('MMMM Y');
            $now4 = Carbon::createFromFormat('Y-m-d',$now4)->locale('es')->isoFormat('MMMM Y');

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

        }catch(Exception $err){
            return response()->json([
                'res'=>false,
                'msg'=>$err->getMessage(),
            ]);
        }

    }

    public function getPedidosUltimos4Meses(){
        try{

            $now1 = Carbon::now()->toDateString();
            $now2 = Carbon::now()->subMonth(1)->toDateString();
            $now3 = Carbon::now()->subMonth(2)->toDateString();
            $now4 = Carbon::now()->subMonth(3)->toDateString();
            $mes1 = DB::select("select fu_obtenerPedidosEmitidosXMes('$now1') AS pedidosEmiMes1");
            $mes2 = DB::select("select fu_obtenerPedidosEmitidosXMes('$now2') AS pedidosEmiMes2");
            $mes3 = DB::select("select fu_obtenerPedidosEmitidosXMes('$now3') AS pedidosEmiMes3");
            $mes4 = DB::select("select fu_obtenerPedidosEmitidosXMes('$now4') AS pedidosEmiMes4");

            $now1 = Carbon::createFromFormat('Y-m-d',$now1)->locale('es')->isoFormat('MMMM Y');
            $now2 = Carbon::createFromFormat('Y-m-d',$now2)->locale('es')->isoFormat('MMMM Y');
            $now3 = Carbon::createFromFormat('Y-m-d',$now3)->locale('es')->isoFormat('MMMM Y');
            $now4 = Carbon::createFromFormat('Y-m-d',$now4)->locale('es')->isoFormat('MMMM Y');

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
                        $mes1[0]->pedidosEmiMes1,
                        $mes2[0]->pedidosEmiMes2,
                        $mes3[0]->pedidosEmiMes3,
                        $mes4[0]->pedidosEmiMes4
                    ]
                ]
            ]);

        }catch(Exception $err){
            return response()->json([
                'res'=>false,
                'msg'=>$err->getMessage(),
            ]);
        }
    }

}

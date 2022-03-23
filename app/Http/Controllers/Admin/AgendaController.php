<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgendaController extends Controller
{
    public function index(){

        return view('admin.agenda.index');
    }

    public function getEvents(Request $request){
        //if($request->ajax()){
            $eventos = Evento::all();
            return response()->json($eventos);
        //}
    }
    public function storeEvent(Request $request){
        $rules = [
            'title'=>'required',
            'start'=>'required|date',
            'end'=>'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'res' => false,
                'errors'  => $validator->errors()
            ]);
        }

        Evento::create($request->all());

        return response()->json([
            'res'=>true,
            'data'=>['icon'=>'success','msg'=>'Evento registrado correctamente']
        ]);
    }

    public function updateEvent(Request $request){
        $rules = [
            'title'=>'required',
            'start'=>'required|date',
            'end'=>'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'res' => false,
                'errors'  => $validator->errors()
            ]);
        }

        $event = Evento::find($request->id_event);
        $event->update($request->all());

        return response()->json([
            'res'=>true,
            'data'=>['icon'=>'success','msg'=>'Evento actualizado correctamente']

        ]);
    }

    public function deleteEvent($id){
        $event = Evento::find($id);
        $event->delete();

        return response()->json([
            'res'=>true,
            'data'=>['icon'=>'success','msg'=>'Evento eliminado']
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrdenCompra;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Storage;
use App\Models\File;

class FileController extends Controller
{
    public function getFilesOC($id){
        try{
            $oc = OrdenCompra::find($id);
            return response()->json([
                'res'=>true,
                'data'=>$oc->files
            ]);
        }catch(Exception $err){
            return response()->json([
                'res'=>false,
                'error'=>'ocurrio un error '.$err
            ]);
        }
    }
    public function addFilesOC (Request $request){

        try{
            $oc = OrdenCompra::find($request->id_OC);

            $file = $request->file('file_OC');
            $nombreFile = $oc->codigoOC.'-'.time().'.'.$file->guessExtension();
            $url = Storage::putFileAs('admin/filesOC',$request->file('file_OC'),$nombreFile);

            $oc->files()->create([
                'url'=>$url,
                'descripcion'=>$request->descrip_file_OC,
                'tipo_archivo'=>$file->getMimeType()
            ]);

            return response()->json([
                'res'=>true,
                'data'=>['icon'=>'success','msg'=>'File subido correctamente']
            ]);
        }catch(Exception $err){
            return response()->json([
                'res'=>false,
                'error'=>'ocurrio un error '.$err
            ]);
        }
    }
    public function updateFilesOC(Request $request){
        $file = File::find($request->id_file);
        $fileUpdate = ["descripcion"=>$request->descrip_file_OC];

        if($request->hasFile('file_OC')){
            Storage::delete($file->url);

            $fileNew = $request->file('file_OC');
            $nombreFile = $file->fileable->codigoOC.'-'.time().'.'.$fileNew->guessExtension();
            $url = Storage::putFileAs('admin/filesOC',$request->file('file_OC'),$nombreFile);

            $fileUpdate = array_merge($fileUpdate,["url"=>$url,"tipo_archivo"=>$fileNew->getMimeType()]);

        }

        $file->update($fileUpdate);

        return response()->json([
            'res'=>true,
            'data'=>['icon'=>'success','msg'=>'El archivo se actualizo']
        ]);
    }
    public function deleteFilesOC($id){
        $file = File::find($id);
        Storage::delete($file->url);
        $file->delete();
        return response()->json([
            'res'=>true,
            'data'=>['icon'=>'success','msg'=>'El archivo se elimino']
        ]);
    }
}

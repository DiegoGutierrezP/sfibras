<?php

use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CotizacionController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\MiEmpresaController;
use App\Http\Controllers\Admin\OrdenCompraController;
use App\Http\Controllers\Admin\PagosController;
use App\Models\OrdenCompra;

Route::get('/',function(){
    return view('admin.index');
});

Route::get('clientes',[ClienteController::class,'index'])->name('admin.clientes.index');
Route::get('clientes/{cliente}',[ClienteController::class,'show'])->name('admin.clientes.show');

//Cotizaciones
Route::get('cotizacion',[CotizacionController::class,'index'])->name('admin.cotizacion.index');
Route::get('cotizacion-create',[CotizacionController::class,'create'])->name('admin.cotizacion.create');
Route::get('cotizacion/clonar/{id}',[CotizacionController::class,'clonar'])->name('admin.cotizacion.clonar');
Route::post('cotizacion/clonar',[CotizacionController::class,'storeClonar'])->name('admin.cotizacion.clonar.store');
Route::get('cotizacion/{id}',[CotizacionController::class,'show'])->name('admin.cotizacion.show');
Route::get('cotizacion/categoria/{id}/products',[CotizacionController::class,'getProductosxCategoria'])->name('cotizacion.getProductsxCate');
Route::get('cotizacion/product/{id}',[CotizacionController::class,'getProduct'])->name('cotizacion.getProduct');
Route::delete('cotizacion/{id}',[CotizacionController::class,'delete'])->name('cotizacion.delete');
Route::post('cotizacion/generar',[CotizacionController::class,'generarCotizacion'])->name('admin.cotizacion.generar');
Route::get('cotizacion-pdf/{id}',[CotizacionController::class,'pdfCotizacion'])->name('admin.cotizacion.pdf');
Route::post('cotizacion/cambiarEstado',[CotizacionController::class,'cambiarEstadoCoti'])->name('admin.cotizacion.cambiarEstado');
Route::post('cotizacion/informationAceptada',[CotizacionController::class,'informationCotiAceptada'])->name('cotizacion.informationAceptada');

//Orden de Compra
Route::get('ordenCompra',[OrdenCompraController::class,'index'])->name('admin.ordenCompra.index');
Route::get('ordenCompra/create/{coti?}',[OrdenCompraController::class,'create'])->name('admin.ordenCompra.create');
Route::post('ordenCompra/store',[OrdenCompraController::class,'store'])->name('admin.ordenCompra.store');
Route::get('ordenCompra/{id}',[OrdenCompraController::class,'show'])->name('admin.ordenCompra.show');
Route::get('ordenCompra/dates/{id}',[OrdenCompraController::class,'getdatesOC'])->name('admin.ordenCompra.getDatesOC');
Route::put('updateDatesOC',[OrdenCompraController::class,'updateDatesOC'])->name('admin.ordenCompra.updateDatesOC');

/* Route::get('ordenCompra/files/{id}',[OrdenCompraController::class,'getFilesOC'])->name('admin.ordenCompra.getFilesOC');
Route::post('ordenCompra/files/add',[OrdenCompraController::class,'addFilesOC'])->name('admin.ordenCompra.addFilesOC');
Route::post('ordenCompra/files/update',[OrdenCompraController::class,'updateFilesOC'])->name('admin.ordenCompra.updateFilesOC');
Route::delete('ordenCompra/files/{id}',[OrdenCompraController::class,'deleteFilesOC'])->name('admin.ordenCompra.deleteFilesOC'); */

Route::get('files/oc/{id}',[FileController::class,'getFilesOC'])->name('admin.files.getFilesOC');
Route::post('files/oc',[FileController::class,'addFilesOC'])->name('admin.files.addFilesOC');
Route::post('files/oc/update',[FileController::class,'updateFilesOC'])->name('admin.files.updateFilesOC');
Route::delete('files/{id}/oc',[FileController::class,'deleteFilesOC'])->name('admin.files.deleteFilesOC');

Route::get('pagos/oc/{id}',[PagosController::class,'getPagosOC'])->name('admin.pagos.getPagosOC');
Route::post('pagos/oc',[PagosController::class,'addPagoOC'])->name('admin.pagos.addPagosOC');
Route::post('pagos/update/oc',[PagosController::class,'updatePagoOC'])->name('admin.pagos.updatePagosOC');

Route::resource('miEmpresa',MiEmpresaController::class)->only(['index','edit','update'])->names('admin.miEmpresa');



<?php

use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CotizacionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\MiEmpresaController;
use App\Http\Controllers\Admin\OrdenCompraController;
use App\Http\Controllers\Admin\PagosController;
use App\Models\OrdenCompra;

Route::get('/',function(){
    return view('admin.index');
})->middleware('can:p.admin.home')->name('admin.home');

Route::get('clientes',[ClienteController::class,'index'])->name('admin.clientes.index');
Route::get('clientes/{id}',[ClienteController::class,'show'])->name('admin.clientes.show');
Route::get('clientes/{id}/oc',[ClienteController::class,'getOCxCliente'])->name('admin.clientes.getOCxCliente');
Route::get('clientes/{id}/deudas/oc',[ClienteController::class,'getDeudas'])->name('admin.clientes.getDeudas');

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
Route::get('ordenCompra/{id}/edit',[OrdenCompraController::class,'edit'])->name('admin.ordenCompra.edit');
Route::get('ordenCompra/create/{coti?}',[OrdenCompraController::class,'create'])->name('admin.ordenCompra.create');
Route::post('ordenCompra/store',[OrdenCompraController::class,'store'])->name('admin.ordenCompra.store');
Route::post('ordenCompra/{id}/update',[OrdenCompraController::class,'update'])->name('admin.ordenCompra.update');
Route::delete('ordenCompra/{id}',[OrdenCompraController::class,'cancel'])->name('admin.ordenCompra.cancel');
Route::get('ordenCompra/{id}',[OrdenCompraController::class,'show'])->name('admin.ordenCompra.show');
Route::get('ordenCompra/dates/{id}',[OrdenCompraController::class,'getdatesOC'])->name('admin.ordenCompra.getDatesOC');
Route::put('updateDatesOC',[OrdenCompraController::class,'updateDatesOC'])->name('admin.ordenCompra.updateDatesOC');
Route::get('ordenCompra/pdf/{id}',[OrdenCompraController::class,'createPdf'])->name('admin.ordenCompra.pdf');

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

Route::get('agenda',[AgendaController::class,'index'])->name('admin.agenda.index');
Route::get('agenda/evento',[AgendaController::class,'getEvents'])->name('admin.agenda.getEvents');
Route::post('agenda/evento/store',[AgendaController::class,'storeEvent'])->name('admin.agenda.storeEvent');
Route::post('agenda/evento/update',[AgendaController::class,'updateEvent'])->name('admin.agenda.updateEvent');
Route::delete('agenda/evento/{id}',[AgendaController::class,'deleteEvent'])->name('admin.agenda.deleteEvent');

//Dashboard
Route::get('dashboard/infoCards',[DashboardController::class,'getInfoCards'])->name('admin.dashboard.getInfoCards');
Route::get('dashboard/ingresosChart',[DashboardController::class,'getIngresosUltimos4Meses'])->name('admin.dashboard.getIngresosUltimos4Meses');
Route::get('dashboard/pedidosChart',[DashboardController::class,'getPedidosUltimos4Meses'])->name('admin.dashboard.getPedidosUltimos4Meses');



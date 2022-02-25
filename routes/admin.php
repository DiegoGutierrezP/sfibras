<?php

use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CotizacionController;
use App\Http\Controllers\Admin\MiEmpresaController;

Route::get('/',function(){
    return view('admin.index');
});

Route::get('clientes',[ClienteController::class,'index'])->name('admin.clientes.index');
Route::get('clientes/{cliente}',[ClienteController::class,'show'])->name('admin.clientes.show');

Route::get('cotizacion',[CotizacionController::class,'index'])->name('admin.cotizacion.index');
Route::get('cotizacion/create',[CotizacionController::class,'create'])->name('admin.cotizacion.create');
Route::get('cotizacion/clonar',[CotizacionController::class,'clonar'])->name('admin.cotizacion.clonar');
Route::get('cotizacion/{id}',[CotizacionController::class,'show'])->name('admin.cotizacion.show');
Route::get('cotizacion/categoria/{id}/products',[CotizacionController::class,'getProductosxCategoria'])->name('cotizacion.getProductsxCate');
Route::get('cotizacion/product/{id}',[CotizacionController::class,'getProduct'])->name('cotizacion.getProduct');
Route::post('cotizacion/generar',[CotizacionController::class,'generarCotizacion'])->name('admin.cotizacion.generar');
Route::get('cotizacion-pdf/{id}',[CotizacionController::class,'pdfCotizacion'])->name('admin.cotizacion.pdf');

Route::resource('miEmpresa',MiEmpresaController::class)->only(['index','edit','update'])->names('admin.miEmpresa');



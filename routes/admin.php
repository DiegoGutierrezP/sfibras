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

Route::get('cotizacion',[CotizacionController::class,'index'])->name('admin.cotizacion.index');
Route::get('cotizacion/categoria/{id}/products',[CotizacionController::class,'getProductosxCategoria'])->name('cotizacion.getProductsxCate');

Route::resource('miEmpresa',MiEmpresaController::class)->names('admin.miEmpresa');



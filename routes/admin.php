<?php

use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return view('admin.index');
});

Route::resource('clientes',ClienteController::class)->names('admin.clientes');



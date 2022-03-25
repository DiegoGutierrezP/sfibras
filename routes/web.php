<?php

use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Livewire\Cliente\Servicios;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('nosotros','nosotros')->name('nosotros');

Route::get('servicios/{servicio?}',Servicios::class)->name('servicios');

Route::view('contacto','contacto')->name('contacto');

Route::group(['middleware'=>'auth'],function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //User
    Route::view('profile','user.profile')->name('profile');
    Route::put('profile',[ProfileController::class,'update'])->name('profile.update');

});

require __DIR__.'/auth.php';

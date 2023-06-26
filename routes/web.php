<?php

use App\Http\Controllers\MaterialesController;
use App\Http\Controllers\MuebleController;
use App\Http\Controllers\MuebleMaterialController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [MuebleController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/materiales', [MaterialesController::class, 'index'])->name('materiales');
    Route::post('/materiales', [MaterialesController::class, 'store'])->name('materiales');
    Route::patch('/materiales/{material}', [MaterialesController::class, 'update'])->name('materiales.update');
    //Route::post('/materiales/{material}', [MaterialesController::class, 'update'])->name('materiales.update');
    Route::delete('/materiales/{material}', [MaterialesController::class, 'destroy'])->name('materiales.destroy');
    Route::post('/muebles', [MuebleController::class, 'store'])->name('muebles');
    Route::patch('/muebles/{mueble}', [MuebleController::class, 'update'])->name('muebles.update');
    Route::delete('/muebles/{mueble}', [MuebleController::class, 'destroy'])->name('muebles.destroy');
    //Route::patch('/muebles/{material}', [MuebleController::class, 'update'])->name('muebles.update');
    Route::get('/editarMueble/{mueble}', [MuebleMaterialController::class, 'index'])->name('editarMueble');
    Route::post('/muebleMaterial', [MuebleMaterialController::class, 'store'])->name('mueble_material.store');
    Route::delete('/muebleMaterial/{muebleMaterial}', [MuebleMaterialController::class, 'destroy'])->name('mueble_material.destroy');

});

require __DIR__.'/auth.php';

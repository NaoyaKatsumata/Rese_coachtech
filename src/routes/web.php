<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationControlloer;
use App\Http\Controllers\MenuController;
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




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/edit',[MenuController::class,'edit']);
    Route::put('/',[Shopcontroller::class,'favorite']);
    Route::put('/done',[MenuController::class,'update']);
    Route::post('/done',[ReservationControlloer::class,'done']);
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/mypage',[MenuController::class,'mypage']);
    Route::put('/delete',[MenuController::class,'delete']);
});
Route::get('/', [Shopcontroller::class,'shopAll']);
Route::patch('/',[Shopcontroller::class,'search']);
Route::get('/detail', [Shopcontroller::class,'detail']);


require __DIR__.'/auth.php';

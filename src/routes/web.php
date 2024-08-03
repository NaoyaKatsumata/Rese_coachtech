<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationControlloer;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShopEditController;
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
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/',[Shopcontroller::class,'favorite']);
    Route::post('/edit',[MypageController::class,'edit']);
    Route::put('/done',[MypageController::class,'update']);
    Route::post('/mypage',[MypageController::class,'mypage']);
    Route::put('/delete',[MypageController::class,'delete']);
    Route::post('/review',[MypageController::class,'review']);
    Route::post('/done',[ReservationControlloer::class,'done']);
    Route::post('/store',[ReviewController::class,'store']);
    Route::put('editOwner',[ShopEditController::class,'editOwner']);
    Route::patch('editDetail',[ShopEditController::class,'editDetail']);
    Route::get('/addShop',[ShopEditController::class,'addShop']);
    Route::post('/editstore',[ShopEditController::class,'store']);
    Route::post('/info',[ShopEditController::class,'createMail']);
    Route::post('/sendMailComp',[ShopEditController::class,'sendMail']);
});
Route::get('/', [Shopcontroller::class,'shopAll']);
Route::patch('/',[Shopcontroller::class,'search']);
Route::get('/detail', [Shopcontroller::class,'detail']);


require __DIR__.'/auth.php';

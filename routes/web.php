<?php
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\Qrcode\Generator;

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
    Route::get('/', function() {
    return view('home');
    });

    Route::get('/home', function() {
        return view('home');
            })->name('home')->middleware('auth');

    Route::resource('users', \App\Http\Controllers\UserController::class)
        ->middleware('auth');
        
    Route::resource('produks', \App\Http\Controllers\ProdukController::class)
        ->middleware('auth');
    // Route::get('produks', [ProdukController::class, 'index'])
        // ->middleware('auth');
        // Route::get('/produks', function(){
        //     return "arsyad";
        // });

    

    // Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Auth::routes();

    // Route::get('/users', [UserController::class, 'index']);
    Route::get('qrcode/{id}', [UserController::class, 'generate'])->name('generate')
         ->middleware('auth');
    

    // Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/scan', function(){
        return view('scan');
    });
    Route::get('/welcome', function() {
        return view('welcome');
    });
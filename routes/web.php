<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ElementController;
use App\Http\Controllers\ChecklistInstanceController;

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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->prefix('admin')->group( function() {

    Route::resource('checklist', ChecklistController::class);
    Route::resource('element', ElementController::class);
    Route::resource('checklist-instance', ChecklistInstanceController::class);

});

require __DIR__.'/auth.php';

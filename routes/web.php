<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ListController;
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
Route::group(['middleware' => ['auth']], function() {
    Route::get('/', [ListController::class, 'index'])->name('todo.read');
    Route::post('/create', [ListController::class, 'create'])->name('todo.create');
    Route::post('/update', [ListController::class, 'update'])->name('todo.update');
    Route::get('/delete/{id?}', [ListController::class, 'delete'])->name('todo.delete');
    Route::post('/search', [ListController::class, 'search'])->name('todo.search');

    Route::post('/upload_image', [ImageController::class, 'imageUpload'])->name('todo.image_upload');
    Route::get('/remove_image/{id?}', [ImageController::class, 'removeImage'])->name('todo.remove_image');
});

Route::get('/dashboard', function () {
    return Redirect::route('todo.read');
    // return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

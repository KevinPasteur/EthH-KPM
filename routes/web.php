<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\MessageController;

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

Route::redirect('/', '/login');

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('welcome');
    })->name('home');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['role:Administrateur']], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/change-role/{user}', [AdminController::class, 'changeRole'])->name('admin.changeRole');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
});

Route::middleware(['auth', 'role:Administrateur,Éditeur,Lecteur'])->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
});

Route::middleware(['auth', 'role:Administrateur,Éditeur'])->group(function () {
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
});


Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');

require __DIR__ . '/auth.php';
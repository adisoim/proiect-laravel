<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth', 'role:admin']], function() {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/events', [AdminController::class, 'index'])->name('admin.events.index');
    Route::get('/events/create', [AdminController::class, 'create'])->name('admin.events.create');
    Route::post('/events', [AdminController::class, 'store'])->name('admin.events.store');
    Route::get('/events/{event}/edit', [AdminController::class, 'edit'])->name('admin.events.edit');
    Route::put('/events/{event}', [AdminController::class, 'update'])->name('admin.events.update');
    Route::delete('/events/{event}', [AdminController::class, 'destroy'])->name('admin.events.destroy');
});

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');


require __DIR__.'/auth.php';

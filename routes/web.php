<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\SponsorController;
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

Route::prefix('sponsors')->group(function () {
    Route::get('/', [SponsorController::class, 'index'])->name('sponsors.index');
    Route::get('/create', [SponsorController::class, 'create'])->name('sponsors.create');
    Route::post('/', [SponsorController::class, 'store'])->name('sponsors.store');
    Route::get('/{sponsor}', [SponsorController::class, 'show'])->name('sponsors.show');
    Route::get('/{sponsor}/edit', [SponsorController::class, 'edit'])->name('sponsors.edit');
    Route::put('/{sponsor}', [SponsorController::class, 'update'])->name('sponsors.update');
    Route::delete('/{sponsor}', [SponsorController::class, 'destroy'])->name('sponsors.destroy');
});

Route::get('/agendas', [AgendaController::class, 'index'])->name('agendas.index');
Route::get('/agendas/{agenda}', [AgendaController::class, 'show'])->name('agendas.show');

Route::get('/speakers', [SpeakerController::class, 'index'])->name('speakers.index');
Route::get('/speakers/{speaker}', [SpeakerController::class, 'show'])->name('speakers.show');

// TODO tre sa implementam pag blade pt creare
Route::get('/speakers/create', [SpeakerController::class, 'create'])->name('speakers.create');
Route::post('/speakers', [SpeakerController::class, 'store'])->name('speakers.store');

require __DIR__.'/auth.php';

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

// Rute pentru evenimente
Route::resource('events', EventController::class)->only(['index', 'show']);

// Rute pentru sponsori
Route::resource('sponsors', SponsorController::class);
Route::resource('sponsors', SponsorController::class)->middleware('auth', 'role:admin');
Route::post('/sponsors', [SponsorController::class, 'store'])->name('sponsors.store');
Route::post('/admin/events/{eventId}/sponsors', [AdminController::class, 'storeSponsors'])->name('admin.events.storeSponsors');
Route::delete('/events/{event}/remove-sponsor', [AdminController::class, 'removeSponsor'])->name('events.removeSponsor');
Route::delete('/sponsors/{sponsor}', [AdminController::class, 'destroySponsor'])->name('sponsors.destroy');

// Rute pentru admin
Route::group(['middleware' => ['auth', 'role:admin']], function() {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/events', [AdminController::class, 'index'])->name('admin.events.index');
    Route::get('admin/events/create', [AdminController::class, 'create'])->name('admin.events.create');
    Route::post('admin/events', [AdminController::class, 'store'])->name('admin.events.store');
    Route::get('admin/events/{event}/edit', [AdminController::class, 'edit'])->name('admin.events.edit');
    Route::put('admin/events/{event}', [AdminController::class, 'update'])->name('admin.events.update');
    Route::delete('admin/events/{event}', [AdminController::class, 'destroy'])->name('admin.events.destroy');

    // Ruta pentru adăugarea sponsori la un eveniment
    Route::get('admin/events/{event}/add-sponsor', [AdminController::class, 'addSponsors'])->name('events.addSponsors');
    Route::post('admin/events/{event}/add-sponsor', [AdminController::class, 'storeSponsors']);
    Route::post('events/{event}/remove-sponsor', [AdminController::class, 'removeSponsor'])->name('events.removeSponsor');
});



Route::get('/agendas', [AgendaController::class, 'index'])->name('agendas.index');
Route::get('/agendas/{agenda}', [AgendaController::class, 'show'])->name('agendas.show');

Route::get('/speakers', [SpeakerController::class, 'index'])->name('speakers.index');
Route::get('/speakers/{speaker}', [SpeakerController::class, 'show'])->name('speakers.show');

// TODO tre sa implementam pag blade pt creare
Route::get('/speakers/create', [SpeakerController::class, 'create'])->name('speakers.create');
Route::post('/speakers', [SpeakerController::class, 'store'])->name('speakers.store');

require __DIR__.'/auth.php';

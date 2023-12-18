<?php

// Importarea controlerelor utilizate în rute
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Înregistrarea rutelor web pentru aplicație. Aceste rute sunt încărcate de
| RouteServiceProvider și sunt asignate grupului de middleware "web".
|
*/

// Ruta de bază care returnează pagina de bun venit
Route::get('/', function () {
    return view('welcome');
});

// Ruta pentru tabloul de bord, cu middleware pentru autentificare și verificare
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup de rute pentru profil, cu middleware pentru autentificare
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute pentru gestionarea evenimentelor
Route::resource('events', EventController::class)->only(['index', 'show']);
Route::get('/locations', [EventController::class, 'locations'])->name('events.locations');

// Rute specifice pentru administratori, cu middleware pentru autentificare și rolul de admin
Route::group(['middleware' => ['auth', 'role:admin']], function() {
    // Rute pentru gestionarea evenimentelor de către admin
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/events', [AdminController::class, 'index'])->name('admin.events.index');
    Route::get('admin/events/create', [AdminController::class, 'create'])->name('admin.events.create');
    Route::post('admin/events', [AdminController::class, 'store'])->name('admin.events.store');
    Route::get('admin/events/{event}/edit', [AdminController::class, 'edit'])->name('admin.events.edit');
    Route::put('admin/events/{event}', [AdminController::class, 'update'])->name('admin.events.update');
    Route::delete('admin/events/{event}', [AdminController::class, 'destroy'])->name('admin.events.destroy');

    // Rute pentru adăugarea și înlăturarea de sponsori și vorbitori la evenimente
    Route::get('admin/events/{event}/add-sponsor', [AdminController::class, 'addSponsor'])->name('events.addSponsor');
    Route::post('admin/events/{event}/add-sponsor', [AdminController::class, 'storeSponsors']);
    Route::delete('admin/events/{event}/remove-sponsor', [AdminController::class, 'removeSponsor'])->name('events.removeSponsor');

    Route::get('admin/events/{event}/add-speaker', [AdminController::class, 'addSpeakerForm'])->name('admin.events.addSpeakerForm');
    Route::post('admin/events/{event}/add-speaker', [AdminController::class, 'addSpeaker'])->name('admin.events.addSpeakers');
    Route::post('admin/events/{event}/store-speakers', [AdminController::class, 'storeSpeakers'])->name('admin.events.storeSpeakers');
    Route::delete('admin/events/{event}/remove-speaker', [AdminController::class, 'removeSpeaker'])->name('admin.events.removeSpeaker');
    Route::delete('/speakers/{speaker}', [SpeakerController::class, 'destroy'])->name('speakers.destroy');
    Route::delete('/events/remove-speaker/{event}', [AdminController::class, 'removeSpeaker'])->name('events.removeSpeaker');


// Rute pentru gestionarea sponsorilor
    Route::resource('sponsors', SponsorController::class);
    Route::post('/sponsors', [SponsorController::class, 'store'])->name('sponsors.store');
    Route::post('/admin/events/{eventId}/sponsors', [AdminController::class, 'storeSponsors'])->name('admin.events.storeSponsors');
    Route::delete('/sponsors/{sponsor}', [AdminController::class, 'destroySponsor'])->name('sponsors.destroy');
    Route::get('/sponsors/{sponsor}/edit', [SponsorController::class, 'edit'])->name('sponsors.edit');

    // Rute pentru gestionarea partenerilor și vorbitorilor
    Route::get('/speakers/create', [SpeakerController::class, 'create'])->name('speakers.create');
    Route::post('/speakers', [SpeakerController::class, 'store'])->name('speakers.store');
    Route::get('/partners/create', [PartnerController::class, 'create'])->name('partners.create');
    Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
    Route::get('admin/events/{event}/add-partner', [AdminController::class, 'addPartnerForm'])->name('admin.events.addPartnerForm');
    Route::post('admin/events/{event}/add-partner', [AdminController::class, 'addPartner'])->name('admin.events.addPartner');
    Route::post('admin/events/{event}/store-partners', [AdminController::class, 'storePartners'])->name('admin.events.storePartners');
    Route::delete('admin/events/{event}/remove-partner/{partner}', [AdminController::class, 'removePartner'])->name('admin.events.removePartner');
    Route::post('/partners', [PartnerController::class, 'store'])->name('partners.store');
    Route::delete('/partners/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy');
    Route::delete('/events/remove-partner/{event}', [AdminController::class, 'removePartner'])->name('events.removePartner');
    Route::delete('/destroy-partner/{partnerId}', 'NumeController@destroyPartner')->name('destroy.partner');
    Route::get('/speakers/{speaker}/edit', [SpeakerController::class, 'edit'])->name('speakers.edit');
    Route::put('/speakers/{speaker}', [SpeakerController::class, 'update'])->name('speakers.update');
    Route::get('/partners/{partner}/edit', [PartnerController::class, 'edit'])->name('partners.edit');
    Route::put('/partners/{partner}', [PartnerController::class, 'update'])->name('partners.update');
});

// Rute pentru coșul de cumpărături și procesul de checkout
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{ticketId}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/cart/confirmation', [CartController::class, 'confirmCheckout'])->name('cart.confirmation');
Route::post('/confirm-checkout', [CartController::class, 'confirmCheckout']);

// Rute pentru agende și vorbitori
Route::get('/agendas', [AgendaController::class, 'index'])->name('agendas.index');
Route::get('/agendas/{agenda}', [AgendaController::class, 'show'])->name('agendas.show');
Route::get('/speakers', [SpeakerController::class, 'index'])->name('speakers.index');
Route::get('/speakers/{speaker}', [SpeakerController::class, 'show'])->name('speakers.show');

// Rute pentru procesul de plată
Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent']);
Route::post('/confirm-checkout', [PaymentController::class, 'confirmCheckout'])->name('confirm-checkout');
Route::get('/cart/confirmation', [CartController::class, 'confirmation'])->name('cart.confirmation');

// Rute pentru gestionarea contactelor
Route::get('/contacts', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

// Includerea rutei pentru autentificare
require __DIR__.'/auth.php';

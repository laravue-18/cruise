<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\PageController;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/coverage', [PageController::class, 'coverage'])->name('coverage');
Route::get('/destinations', [PageController::class, 'destinations'])->name('destinations');

Route::get('/quote/create', [QuoteController::class, 'create'])->name('quote.create');
Route::get('/quote', [QuoteController::class, 'index'])->name('quote.index');
Route::post('/quote', [QuoteController::class, 'store'])->name('quote.store');
Route::get('/quote/{id}', [QuoteController::class, 'show'])->name('quote.show');
Route::post('/products/{product}/price', [QuoteController::class, 'price'])->name('products.price');
Route::get('/quote/{id}/checkout', [QuoteController::class, 'checkout'])->name('quote.checkout');
Route::post('/quote/{id}/checkout', [QuoteController::class, 'purchase'])->name('quote.purchase');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

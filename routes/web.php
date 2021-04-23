<?php

use App\Http\Controllers\Backend\ContactController;
use Illuminate\Support\Facades\Route;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
	// Contact
	Route::get('contacts', [ContactController::class, 'index'])->name('contacts');
	Route::get('contacts/create', [ContactController::class, 'create'])->name('contacts.create');
	Route::post('contacts', [ContactController::class, 'store'])->name('contacts.store');
	Route::get('contacts/{id}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
	Route::put('contacts/{id}', [ContactController::class, 'update'])->name('contacts.update');
	Route::delete('contacts/{id}/photo', [ContactController::class, 'destroyPhoto'])->name('contacts.destroyPhoto');
});
<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\FournisseurController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// Accueil
Route::get('/', function () {
    return view('site.index');
})->name('accueil');

// Apropos 
Route::get('apropos', function () {
    return view('site.apropos');
})->name('apropos');

// Boutique 
Route::get('shop', function () {
    return view('site.boutique');
})->name('boutique');

// Contact
Route::get('contact', function () {
    return view('site.contact');
})->name('contact');

// Service
Route::get('services', function () {
    return view('site.services');
})->name('services');



Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route Dashboard
Route::middleware('auth')->group(function () {
    Route::resource('/categorie', CategoriController::class);
    Route::resource('/fournisseur', FournisseurController::class);
    Route::resource('/produit', ProduitController::class);
});

require __DIR__.'/auth.php';

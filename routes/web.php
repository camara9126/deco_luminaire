<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\MouvementStockController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\VenteController;
use App\Models\Client;
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
    // Route Inventaire
    Route::resource('/categorie', CategorieController::class);
    Route::resource('/fournisseur', FournisseurController::class);
    Route::resource('/produit', ProduitController::class);
    Route::resource('/stock', MouvementStockController::class);
    // Route Commerciale
    Route::resource('/devis', DevisController::class);
    Route::get('devis/{devis}/facture', [DevisController::class, 'facture'])->name('devis.facture');
    Route::get('devis/{devis}/valider', [DevisController::class, 'valider'])->name('devis.valider');
    Route::get('devis/{devis}/refuser', [DevisController::class, 'refuser'])->name('devis.refuser');
    Route::get('devis/{devis}/convertir', [DevisController::class, 'convertir'])->name('devis.convertir');
    Route::resource('/client', ClientController::class);
    Route::resource('/vente', VenteController::class);
    Route::get('/factures', [VenteController::class, 'facture'])->name('factures');

    // Route Finance
    Route::resource('/paiement', PaiementController::class);
    Route::resource('/recette', RecetteController::class);
    Route::resource('/depense', DepenseController::class);
    // Route Entreprise
    Route::resource('/entreprise', EntrepriseController::class);
});

require __DIR__.'/auth.php';

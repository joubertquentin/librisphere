<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AproposController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LivresController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserController;


Route::get('/accueil', [AccueilController::class, 'index'])->name('accueil');
Route::get('/apropos', [AproposController::class, 'index'])->name('apropos');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'envoyer'])->name('contact.envoyer');
Route::get('/livres', [LivresController::class, 'index'])->name('livres');
Route::get('/panier', [PanierController::class, 'index'])->name('panier');
Route::post('/ajoutpanier', [PanierController::class, 'ajoutAuPanier'])->name('ajoutpanier');
Route::post('/valider-commande', [PanierController::class, 'validerCommande'])->name('panier.valider');
Route::post('/commande/{id}/supprimer', [PanierController::class, 'supprimerCommande'])->name('commande.supprimer');
Route::post('/supprimer-panier/{index}', [PanierController::class, 'supprimerDuPanier'])->name('panier.supprimer');
Route::get('/', [ConnexionController::class, 'index'])->name('connexion');
Route::post('/connect', [ConnexionController::class, 'connect'])->name('connect');
Route::get('/reset-password', [PasswordController::class, 'index'])->name('reset-password');
Route::post('/reset-password', [PasswordController::class, 'resetPassword']);
Route::get('/inscription', [InscriptionController::class, 'index'])->name('inscription');
Route::post('/inscription', [InscriptionController::class, 'enregistrer'])->name('inscription.store');
Route::get('/changer-username', [UserController::class, 'afficherChangerNomForm'])->name('changer-username');
Route::post('/changer-username', [UserController::class, 'changerNom'])->name('changer-username.submit');

Route::post('/deconnexion', function () {
    session()->forget('utilisateur');
    return redirect()->route('connexion');
})->name('deconnexion');


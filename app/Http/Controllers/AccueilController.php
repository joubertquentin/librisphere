<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccueilController extends Controller
{
    public function index()
{
    $utilisateur = session('utilisateur');

    if (!$utilisateur) {
        return redirect()->route('connexion');
    }

    $data = [
        'nom' => $utilisateur->nom,
        'prenom' => $utilisateur->prenom
    ];

    return view('index', $data);
}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AproposController extends Controller
{
    public function index()
    {
        
        $utilisateur = session('utilisateur');

        
        return view('apropos', compact('utilisateur'));
    }
}

?>
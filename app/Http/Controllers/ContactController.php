<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ContactMail;

use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    

    
    
    public function envoyer(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'categorie' => 'required|string',
            'sous_categorie' => 'required|string',
            'message' => 'required|string',
        ]);
    
        Mail::to('premierprojetbibliotheque@gmail.com')->send(new ContactMail($validated));

        Mail::raw('Test depuis Mailgun', function($message) {
            $message->to('premierprojetbibliotheque@gmail.com')->subject('Test Mailgun');
        });
    
        return redirect()->back()->with('success', 'Votre message a bien été envoyé !');
    }
    

    public function index()
    {
        
        $utilisateur = session('utilisateur');

        
        return view('contact', compact('utilisateur'));
    }
}

?>
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\Validator;

class ConnexionController extends Controller
{
    public function index()
    {
        return view('connexion'); 
    }

    
    
    public function connect(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('mdp');
    
        $user = Utilisateur::where('email', $email)->first();
    
        if ($user && Hash::check($password, $user->mdp)) {
            
            session(['utilisateur' => $user]);
    
            return redirect()->route('accueil');
        } else {
            return back()->withErrors(['email' => 'Email ou mot de passe incorrect'])->withInput();
        }
    }

    public function showResetPasswordForm()
    {
        return view('resetPassword');
    }

    
    public function resetPassword(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:utilisateurs,email',
            'new_password' => 'required|min:8|confirmed', 
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        
        $user = Utilisateur::where('email', $request->email)->first();

        if ($user) {
            
            $user->mdp = Hash::make($request->new_password);
            $user->save();

            return redirect()->route('connexion')->with('success', 'Mot de passe réinitialisé avec succès.');
        }

        return back()->withErrors(['email' => 'Aucun utilisateur trouvé avec cet e-mail.']);
    }
    
}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    public function afficherChangerNomForm()
    {
        return view('changer-username');
    }

    
    public function changerNom(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:utilisateurs,email',
            'prenom' => 'required|string|min:2',
            'nom' => 'required|string|min:2',
        ]);

        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();  
        }

        
        $user = Utilisateur::where('email', $request->email)->first();

       
        if (!$user) {
            return back()->withErrors(['email' => 'Utilisateur non trouvé']);
        }

        
        $user->prenom = $request->prenom;
        $user->nom = $request->nom;
        $user->save();

        
        return redirect()->route('connexion')->with('success', 'Nom et prénom mis à jour avec succès.');
    }
}
?>
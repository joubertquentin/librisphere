<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Afficher le formulaire pour changer le nom et prénom
    public function afficherChangerNomForm()
    {
        return view('changer-username');
    }

    // Traiter la demande de changement de nom et prénom
    public function changerNom(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:utilisateurs,email',
            'prenom' => 'required|string|min:2',
            'nom' => 'required|string|min:2',
        ]);

        // Si la validation échoue
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();  // Redirige avec les erreurs de validation
        }

        // Récupérer l'utilisateur avec l'email donné
        $user = Utilisateur::where('email', $request->email)->first();

        // Si l'utilisateur n'existe pas
        if (!$user) {
            return back()->withErrors(['email' => 'Utilisateur non trouvé']);
        }

        // Mettre à jour le prénom et le nom
        $user->prenom = $request->prenom;
        $user->nom = $request->nom;
        $user->save();

        // Rediriger vers la page de connexion avec un message de succès
        return redirect()->route('connexion')->with('success', 'Nom et prénom mis à jour avec succès.');
    }
}
?>
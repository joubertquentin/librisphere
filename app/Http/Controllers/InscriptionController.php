<?php
namespace App\Http\Controllers;
use App\Models\Inscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InscriptionController extends Controller
{
    public function enregistrer(Request $request)
    {
        
        $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:utilisateurs,email',
            'mdp' => 'required|string|min:6',
        ]);

        
        Inscription::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'mdp' => Hash::make($request->mdp),
        ]);

        return redirect()->route('connexion')->with('success', 'Inscription réussie !');
    }

    public function index()
{
    return view('inscription');
}

}
?>
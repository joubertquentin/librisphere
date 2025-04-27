<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Livre;

class PanierController extends Controller
{
    
    public function index()
{
    $utilisateur = session('utilisateur');

    if (!$utilisateur) {
        return redirect()->route('connexion');
    }

    $panier = session('panier', []);

    
    $commandes = DB::table('commandes')->get()->map(function ($commande) {
        return (array) $commande;
    })->toArray();

    $data = [
        'nom' => $utilisateur->nom,
        'prenom' => $utilisateur->prenom,
        'panier' => $panier,
        'commandes' => $commandes,
    ];

    return view('panier', $data);
}




    
    public function ajoutAuPanier(Request $request)
{
    
    $livre = $request->only(['nom', 'prix']);
    $panier = session('panier', []);  

    
    $idLivre = md5($livre['nom']); 

    
    if (empty($livre['nom']) || empty($livre['prix'])) {
        
        return response()->json(['message' => 'Le livre n\'a pas toutes les informations nécessaires.'], 400);
    }

    
    if (isset($panier[$idLivre])) {
        $panier[$idLivre]['quantite'] += 1;
    } else {
        
        $livre['quantite'] = 1;
        $panier[$idLivre] = $livre;
    }

    session(['panier' => $panier]);

    return response()->json(['message' => 'Le livre a été ajouté au panier !', 'livre' => $livre['nom']], 200);
}







    
    public function supprimerDuPanier($index)
    {
        $panier = session('panier', []);
    
        if (isset($panier[$index])) {
            $livrePanier = $panier[$index];
    
            
            $livreDB = Livre::where('titre', $livrePanier['nom'])->first();
    
            if ($livreDB) {
                
                $livreDB->stock += $livrePanier['quantite'];
                $livreDB->save();
            }
    
            unset($panier[$index]); 
            session(['panier' => $panier]);
        }
    
        return redirect()->route('panier');
    }

    

public function validerCommande(Request $request)
{
    $utilisateur = session('utilisateur');
    $panier = session('panier', []);

    
    if (empty($panier)) {
        return redirect()->route('panier')->with('erreur', 'La commande ne doit pas être vide.');
    }

    
    $validated = $request->validate([
        'adresse' => 'required|string',
        'titulaire' => 'required|string',
        'numero_carte' => 'required|digits:16',
        'cryptogramme' => 'required|digits:3',
    ]);

   
$nbrLivres = array_sum(array_column($panier, 'quantite'));


DB::table('commandes')->insert([
    'acheteur' => $validated['titulaire'],
    'livraison' => $validated['adresse'],
    'numero_carte' => $validated['numero_carte'],
    'cryptogramme' => $validated['cryptogramme'],
    'nbrlivres' => $nbrLivres,
    'livres' => json_encode(array_values($panier)), 
    'date_commande' => now(),
]);


    
    session()->forget('panier');

    return redirect()->route('panier')->with('success', 'Commande validée et enregistrée avec succès.');
}



public function supprimerCommande($id)
{
    
    DB::table('commandes')->where('id', $id)->delete();

    return redirect()->route('panier')->with('success', 'Commande supprimée avec succès.');
}

}

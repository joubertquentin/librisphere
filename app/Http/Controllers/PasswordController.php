<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    
    public function index()
    {
        return view('reset-password');
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

    if (!$user) {
        return back()->withErrors(['email' => 'Utilisateur non trouvé']);
    }

    $user->mdp = Hash::make($request->new_password);
    $user->save();
    

    return redirect()->route('connexion')->with('success', 'Mot de passe réinitialisé avec succès.');
}


}
?>
<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Connexion
{
    public static function verifierUtilisateur($email, $password)
    {
        $user = DB::table('utilisateurs')->where('email', $email)->first();

        if ($user && Hash::check($password, $user->mdp)) {
            return [
                'id'     => $user->id,
                'email'  => $user->email,
                'prenom' => $user->prenom,
                'nom'    => $user->nom,
            ];
        }

        return null;
    }
}

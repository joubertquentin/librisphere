<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    protected $table = 'utilisateurs';

    protected $primaryKey = 'id';

    
    protected $fillable = ['nom', 'email'];

    
    public $timestamps = false;

    
    public static function getUtilisateurs()
    {
        return self::all();
    }

    
    public static function getUtilisateur($id)
    {
        return self::find($id);
    }
}


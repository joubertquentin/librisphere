<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $table = 'utilisateurs'; 
    protected $fillable = ['nom', 'prenom', 'email', 'mdp'];
    public $timestamps = false; 
}
?>
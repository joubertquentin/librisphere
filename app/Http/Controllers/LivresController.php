<?php
namespace App\Http\Controllers;

use App\Models\Livre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LivresController extends Controller
{
    public function index(Request $request) 
    {
        $query = Livre::query(); 

        
        if ($request->has('recherche') && !empty($request->recherche)) {
            $query->where('titre', 'like', '%' . $request->recherche . '%');
        }

        
        $livres = $query->get();

        return view('livres', compact('livres'));
    }
}


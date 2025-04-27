<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet"> 
    <link rel="icon" type="image/x-icon"
        href="Logo_librisphère.png">
    <title>Inscription</title>
    <style>
        .link a { color: white; background-color: brown; border-radius: 15px; padding: 5px; text-decoration: none; }
        .link a:hover { transition: all 0.3s ease-in-out; background-color: black; }
        .btn { background-color: brown; color: white; }
        .btn:hover { transition: all 0.3s ease-in-out; background-color: blue; color: white; }
    </style>
</head>
<body class="text-center">
    <header>
        <h2>Inscription</h2>
    </header><br>

    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul style="text-align: left;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    
    <form method="POST" action="{{ route('inscription.store') }}">
        @csrf
        <div class="container" style="width: 50% !important;">
            <div class="row">
                <div class="col" style="background-color: burlywood; border: 3px solid brown;"><br>

                    <div class="form-group">
                        <label for="nom">Nom</label><br>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" placeholder="Dupont" style="border: 3px solid brown;" required>
                    </div><br>

                    <div class="form-group">
                        <label for="prenom">Prénom</label><br>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom') }}" placeholder="Jean" style="border: 3px solid brown;" required>
                    </div><br>

                    <div class="form-group">
                        <label for="email">Email</label><br>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" style="border: 3px solid brown;" required>
                    </div><br>

                    <div class="form-group">
                        <label for="mdp">Mot de passe</label><br>
                        <input type="password" class="form-control" id="mdp" name="mdp" placeholder="12 caractères minimum variés" style="border: 3px solid brown;" required>
                    </div><br><br><br>

                    <div class="link">
                        <a href="{{ route('connexion') }}">Vous avez déjà un compte ? Connectez-vous !</a>
                    </div><br><br><br>

                    <div class="form-group text-center">
                        <button type="submit" class="btn">S'inscrire</button>
                    </div><br><br>

                </div>
            </div>
        </div>
    </form>

    <footer>© 2025 Joubert Quentin<br>Droits réservés</footer>
</body>
</html>

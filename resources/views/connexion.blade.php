<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon"
        href="Logo_librisphère.png">
    <title>Connexion</title>
    <style>
        .link a {
            color: white;
            background-color: brown;
            border-radius: 15px;
            padding: 5px;
            text-decoration: none;
        }
        .link a:hover {
            transition: all 0.3s ease-in-out;
            background-color: black;
        }
        .btn {
            background-color: brown;
            color: white;
        }
        .btn:hover {
            transition: all 0.3s ease-in-out;
            background-color: blue;
            color: white;
        }
    </style>
</head>
<body class="text-center">
    <header>
        <h2>Connexion au compte</h2>
    </header>

    <div class="container" style="width: 50% !important;"><br><br><br>
        <div class="row">
            <div class="col" style="background-color: burlywood; border: 3px solid brown;">
                <form action="{{ route('connect') }}" method="POST"><br><br>
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="background-color: #ffb3b3;">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="email">Adresse Email</label><br><br>
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" style="border: 3px solid brown;" required>
                    </div><br>

                    <div class="form-group">
                        <label for="mdp">Mot de Passe</label><br><br>
                        <input type="password" class="form-control" id="mdp" name="mdp" placeholder="12 caractères minimum variés (symboles,chiffres,majuscules,minuscules)" style="border: 3px solid brown;" required>
                    </div><br><br><br>

                    <div class="link">
                        <a href="{{ route('reset-password') }}">Mot de passe oublié ?</a>
                    </div><br><br><br>
                    <div class="link">
                    <a href="{{ route('changer-username') }}">Changer nom et prénom</a></div><br><br><br>

                    <div class="link">
                        <a href="{{ route('inscription') }}">Vous n'avez pas de compte ? Inscrivez-vous !</a>
                    </div><br><br><br>

                    <div class="form-group text-center">
                        <button type="submit" class="btn">Connexion</button>
                    </div><br>
                </form>
            </div>
        </div>
    </div>

    <footer>© 2025 Joubert Quentin<br>Droits réservés</footer>
</body>
</html>
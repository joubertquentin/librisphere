<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon"
        href="Logo_librisphère.png">
    <title>Réinitialiser le mot de passe</title>
    <style>
        .btn {
            background-color: brown;
            color: white;
        }
        .btn:hover {
            transition: all 0.3s ease-in-out;
            background-color: blue;
            color: white;
        }
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
    </style>
</head>
<body class="text-center">
    <header>
        <h2>Réinitialiser votre mot de passe</h2>
    </header>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="container" style="width: 50% !important;"><br><br><br>
        <div class="row">
            <div class="col" style="background-color: burlywood; border: 3px solid brown;">
                <form action="{{ route('reset-password') }}" method="POST"><br><br>
                    @csrf
                    <div class="form-group">
                        <label for="email">Adresse Email</label><br><br>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre adresse email" style="border: 3px solid brown;" required>
                    </div><br>

                    <div class="form-group">
                        <label for="new_password">Nouveau mot de passe</label><br><br>
                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Entrez votre nouveau mot de passe" style="border: 3px solid brown;" required>
                    </div><br>

                    <div class="form-group">
                        <label for="new_password_confirmation">Confirmer le mot de passe</label><br><br>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirmez votre nouveau mot de passe" style="border: 3px solid brown;" required>
                    </div><br><br>

                    <div class="form-group text-center">
                        <button type="submit" class="btn">Réinitialiser le mot de passe</button>
                    </div><br>

                    <div class="link">
                        <a href="{{ route('connexion') }}">Retour à la connexion</a>
                    </div><br><br><br>
                </form>
            </div>
        </div>
    </div>

    <footer>© 2025 Joubert Quentin<br>Droits réservés</footer>
</body>
</html>

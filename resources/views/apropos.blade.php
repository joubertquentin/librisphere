<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon"
        href="Logo_librisphère.png">
    <title>A propos</title>
</head>
<body class="text-center">
<style>
        h2{background-color: burlywood; border-radius: 15px; padding: 10px;border: 3px solid brown;}
        .container h2{background-color: burlywood;}
        .col p{background-color: antiquewhite; border-radius: 15px;}
        .col h2{border: none;}
        .col {border-color: brown; background-color: burlywood;}
</style>

<header>
    @if(session('utilisateur'))
        <p style="position: absolute; top: 10px; left: 10px; z-index: 1000; background-color: blue; padding: 10px; border-radius: 10px;">
            <b>Bienvenue, {{ session('utilisateur')->prenom }} {{ session('utilisateur')->nom }}.</b>
        </p>
    @endif

    <form action="{{ route('deconnexion') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger" style="position: absolute; top: 10px; right: 10px; z-index: 1000;">Déconnexion</button>
    </form>
    <h1>A propos</h1><br><br>
    <nav>
        <ul>
                <li class="nav-item"><a href="{{ route('accueil') }}" class="nav-link">Accueil</a></li>
                <li class="nav-item"><a href="{{ url('/livres') }}" class="nav-link">Livres</a></li>
                <li class="nav-item"><a href="{{ url('/panier') }}" class="nav-link" id="panier-link">Panier</a></li>
                <li class="nav-itema"><a href="{{ url('/apropos') }}" class="nav-link">A propos</a></li>
                <li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>
        </ul>
    </nav>
</header><br>

<div class="container">
    <h2>Les informations concernant la bibliothèque</h2>
</div><br><br><br>

<div class="container">
    <div class="row">
        <div class="col">
            <br><h2>Auteur du site</h2><br>
            <br><p>Joubert Quentin, étudiant en BTS SIO 2 SLAM au Lycée Paul Sabatier à Carcassonne</p>
        </div>
        <div class="col" style="margin-left: 15px; margin-right: 15px;">
            <br><h2>Date de publication du site</h2><br>
            <br><p>Le site n'est pas encore publié</p>
        </div>
        <div class="col">
            <br><h2>But du site</h2><br>
            <br><p>Ce site est un projet scolaire, il a pour but de pouvoir acheter des livres en ligne avec certaines personnalisations (catégories, nombres de livres, ...etc)</p>
        </div>
    </div>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<footer>© 2025 Joubert Quentin<br>Droits réservés</footer>
</body>
</html>

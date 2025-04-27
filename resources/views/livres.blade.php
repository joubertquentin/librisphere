<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon"
        href="Logo_librisphère.png">
    <title>Les livres</title>
</head>

<body class="text-center">
    <style>
        .col {
            border: none;
            background-color: whitesmoke;
        }

        h2,
        h4 {
            background-color: burlywood;
            border-radius: 15px;
            padding: 10px;
        }

        label {
            background-color: whitesmoke;
        }

        .container {
            background-color: burlywood;
            border: 3px solid brown;
            border-radius: 15px;
        }

        img {
            width: 50%;
        }
    </style>

    <header>
        <p
            style="position: absolute; top: 10px; left: 10px; z-index: 1000; background-color: blue; padding: 10px; border-radius: 10px;">
            <b>Bienvenue, {{ session('utilisateur')->prenom }} {{ session('utilisateur')->nom }}.</b>
        </p>
        <form action="{{ route('deconnexion') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger"
                style="position: absolute; top: 10px; right: 10px; z-index: 1000;">Déconnexion</button>
        </form>
        <h1>Les livres</h1><br><br>
        <nav>
            <ul>
                <li class="nav-item"><a href="{{ route('accueil') }}" class="nav-link">Accueil</a></li>
                <li class="nav-itema"><a href="{{ route('livres') }}" class="nav-link">Livres</a></li>
                <li class="nav-item"><a href="{{ route('panier') }}" class="nav-link" id="panier-link">Panier</a></li>
                <li class="nav-item"><a href="{{ route('apropos') }}" class="nav-link">A propos</a></li>
                <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
            </ul>
        </nav>
    </header><br>

    <div class="container">
        <h2>Tous les livres de la bibliothèque sont affichés ici</h2><br><br><br>
        <form method="GET" action="{{ route('livres') }}" class="d-flex justify-content-center mb-4">
            <input type="text" name="recherche" class="form-control w-50" placeholder="Rechercher un livre..."
                value="{{ request('recherche') }}">
            <button type="submit" class="btn ms-2" style="background-color: brown; color: white;">Rechercher</button>
        </form><br><br><br>

        @forelse ($livres as $index => $livre)
            @if ($index % 2 == 0)
                <div class="row">
            @endif
                <div class="col-md-6" style="background-color: burlywood; border: 3px solid brown; border-radius: 15px;">
                    <h2 style="background-color: burlywood;">{{ $livre->titre }}</h2>
                    <img src="{{ asset($livre->image) }}" alt="Image de {{ $livre->titre }}" class="img-fluid" /><br><br>
                    <p>{{ $livre->description }}</p>
                    <p><b>Auteur/Autrice : </b>{{ $livre->auteur }}</p>
                    <p><b>Date de publication : </b>{{ \Carbon\Carbon::parse($livre->date_creation)->format('Y-m-d') }}</p>
                    <p><b>Catégorie : </b>{{ $livre->categorie }}</p>
                    <p><b>Quantité : </b>{{ $livre->stock }}</p>
                    <p><b>{{ number_format($livre->prix, 2, ',', ' ') }} €</b></p>
                    @if($livre->stock > 0)
                    <button 
    class="btn btn-danger" 
    id="command-button-{{ $livre->id }}" 
    data-nom="{{ $livre->titre }}" 
    data-prix="{{ $livre->prix }}" 
    onclick="ajouterLivreAuPanier(this)"
>
    Mettre au panier
</button><br><br>
                    @else
                        <button class="btn btn-secondary" disabled>
                            Ce livre n'est plus disponible
                        </button><br><br>
                    @endif

                </div>
                @if ($index % 2 == 1 || $index == $livres->count() - 1)
                    </div>
                @endif
        @empty
            <p>Aucun livre disponible.</p>
        @endforelse
    </div>


    <script src="https://kit.fontawesome.com/a076d05399.js"></script>


    <script>
        function ajouterLivreAuPanier(button) {
    var nomLivre = button.getAttribute('data-nom');
    var prixLivre = button.getAttribute('data-prix');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '{{ route('ajoutpanier') }}', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            alert(response.message + " '" + response.livre + "'");
        } else {
            alert("Erreur lors de l'ajout au panier.");
        }
    };
    xhr.send('nom=' + encodeURIComponent(nomLivre) + '&prix=' + encodeURIComponent(prixLivre));
}

    </script>




    <footer>© 2025 Joubert Quentin<br>Droits réservés</footer>
</body>

</html>
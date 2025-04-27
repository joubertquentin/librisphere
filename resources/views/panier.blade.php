<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon"
        href="Logo_librisphère.png">
    <title>Panier</title>
</head>

<body class="text-center">
    <style>
        .col {
            border: none;
            background-color: burlywood;
        }

        h2,
        h4 {
            background-color: burlywood;
            border-radius: 15px;
            padding: 10px;
        }

        label {
            background-color: burlywood;
        }

        .container {
            background-color: burlywood;
            border: 3px solid brown;
            border-radius: 15px;
        }

        .list-group li {
            border-color: brown;
        }

        .alert {
            max-width: 600px;
            margin: 20px auto;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>

    <header>
        <p
            style="position: absolute; top: 10px; left: 10px; z-index: 1000; background-color: blue; padding: 10px; border-radius: 10px;">
            <b>Bienvenue, {{ session('utilisateur.nom') }} {{ session('utilisateur.prenom') }}.</b>
        </p>

        <form action="{{ route('deconnexion') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger"
                style="position: absolute; top: 10px; right: 10px; z-index: 1000;">Déconnexion</button>
        </form>

        <h1>Panier</h1><br><br>
        <nav>
            <ul>
                <li class="nav-item"><a href="{{ route('accueil') }}" class="nav-link">Accueil</a></li>
                <li class="nav-item"><a href="{{ route('livres') }}" class="nav-link">Livres</a></li>
                <li class="nav-itema"><a href="{{ route('panier') }}" class="nav-link" id="panier-link">Panier</a></li>
                <li class="nav-item"><a href="{{ route('apropos') }}" class="nav-link">A propos</a></li>
                <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
            </ul>
        </nav>
    </header><br>

    <div class="container">
        <div class="col">
            <h2>Toutes vos commandes de livres sont affichées ici</h2><br>
            <h4>Toutes les commandes sont chez vous en 1-2 semaines</h4>
        </div>
    </div><br><br><br>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('erreur'))
        <div class="alert alert-danger">
            {{ session('erreur') }}
        </div>
    @endif

    <div class="container"><br>
        @if(empty($panier))
            <h1>Votre panier est vide</h1>
        @else
            <h1>Votre Panier</h1>
            <ul class="list-group">
                @php $total = 0; @endphp
                @foreach($panier as $index => $livre)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $livre['nom'] }} - {{ $livre['quantite'] }} x {{ number_format($livre['prix'], 2) }} €
                        <form method="POST" action="{{ route('panier.supprimer', $index) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </li>
                    @php $total += $livre['quantite'] * floatval($livre['prix']); @endphp
                @endforeach
            </ul>
            <h3 class="mt-3">Total : {{ number_format($total, 2) }} €</h3>
        @endif

        <br>
        <form method="post" action="{{ route('panier.valider') }}">
            @csrf
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse de livraison</label>
                <textarea class="form-control" name="adresse" id="adresse" rows="1" required
                    style="width: 50%; resize: none; margin: 0 auto; display: block;"
                    placeholder="Adresse complète (N°, Rue, Code postal, Ville/Village)"></textarea>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="titulaire" class="form-label">Titulaire de la carte</label>
                        <input name="titulaire" class="form-control" id="titulaire" required
                            style="width: 70%; margin: 0 auto; display: block;"
                            placeholder="Civilité, Nom, Prénom du titulaire de la carte">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="numero_carte" class="form-label">Numéro de la carte</label>
                        <input name="numero_carte" class="form-control" maxlength="16" required
                            style="width: 70%; margin: 0 auto; display: block;"
                            placeholder="Numéro de la carte (16 chiffres)">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="cryptogramme" class="form-label">Cryptogramme</label>
                        <input name="cryptogramme" class="form-control" maxlength="3" required
                            style="width: 70%; margin: 0 auto; display: block;" placeholder="Cryptogramme (3 chiffres)">
                    </div>
                </div>
            </div>
            <button type="submit" id="valider_commande" name="valider_commande" class="btn btn-danger">Valider la
                commande</button><br><br>
        </form>
    </div>



    @if (!empty($commandes))
            <div class="container mt-4">
                <h2>Commandes Validées</h2>
                @foreach ($commandes as $commande)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h4 class="card-title">Commande #{{ $loop->iteration }}</h4>
                                    <p><strong>Date de la commande :</strong> {{ $commande['date_commande'] }}</p>
                                    @if (isset($commande['livres']))
                                            @php
                                                $livres = json_decode($commande['livres']);
                                            @endphp
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Titre</th>
                                                        <th>Quantité</th>
                                                        <th>Prix Unitaire (€)</th>
                                                        <th>Total (€)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $totalGeneral = 0;
                                                    @endphp
                                                    @foreach ($livres as $livre)
                                                                @php
                                                                    $total = $livre->quantite * floatval($livre->prix);
                                                                    $totalGeneral += $total;
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $livre->nom }}</td>
                                                                    <td>{{ $livre->quantite }}</td>
                                                                    <td>{{ number_format($livre->prix, 2) }} €</td>
                                                                    <td>{{ number_format($total, 2) }} €</td>
                                                                </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <h3>Total de cette commande : {{ number_format($totalGeneral, 2) }} €</h3>
                                    @else
                                        <p>Aucun livre trouvé pour cette commande.</p>
                                    @endif
                                    @php
                                        $numero_carte_masque = substr($commande['numero_carte'], 0, 4) . str_repeat('*', 12);
                                        $cryptogramme_masque = str_repeat('*', 3);
                                    @endphp

                                    @if (isset($commande['livraison']))
                                        <p><strong>Adresse de livraison :</strong><br>{{ $commande['livraison'] }}</p>
                                    @else
                                        <p><strong>Adresse de livraison :</strong> Aucune adresse trouvée pour cette commande.</p>
                                    @endif

                                    @if (isset($commande['acheteur']) && isset($commande['numero_carte']) && isset($commande['cryptogramme']))
                                        <p><strong>Informations bancaires :</strong><br>{{ $commande['acheteur'] }} / {{ $numero_carte_masque }}
                                            / {{ $cryptogramme_masque }}</p>
                                    @else
                                        <p><strong>Informations bancaires :</strong> Informations bancaires manquantes.</p>
                                    @endif

                                    <form method="POST" action="{{ route('commande.supprimer', $commande['id']) }}">

                                        @csrf
                                        <button type="submit" name="supprimer_commande" class="btn btn-danger">Supprimer cette
                                            commande</button>
                                    </form>
                                </div>
                            </div>
                @endforeach
            </div>
    @endif



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @if (session('erreur'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
            <div id="erreurToast" class="toast align-items-center text-bg-warning border-0 show" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body" style="font-size: 1.5em; padding: 1rem;">
                        <span style="font-size: 2rem;">⚠️</span> <strong>Erreur :</strong> {{ session('erreur') }}
                    </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Fermer"
                        style="color: black; opacity: 1; outline: none;"></button>
                </div>
            </div>
        </div>
    @endif






</body>

</html>
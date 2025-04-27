<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="Logo_librisphère.png">
    <title>Contact</title>
    <script>
        // Fonction pour mettre à jour les sous-catégories en fonction de la catégorie sélectionnée
        function updateSousCategorie() {
            var categorie = document.getElementById('categorie').value;
            var sousCategorieSelect = document.getElementById('sous_categorie');
            
            // Effacer les options existantes dans le sous-catégorie
            sousCategorieSelect.innerHTML = '<option value="">-- Sélectionnez --</option>';

            // Ajouter les options de sous-catégorie en fonction de la catégorie sélectionnée
            if (categorie === 'Compte') {
                var options = [
                    'Deconnexion du compte impossible',
                    'Problème de récupération de mot de passe',
                    'Modification des informations personnelles'
                ];
            } else if (categorie === 'Livres') {
                var options = [
                    'Disponibilité des livres',
                    'Problèmes de commande',
                    'Problèmes de livraison'
                ];
            } else if (categorie === 'Panier') {
                var options = [
                    'Problèmes de paiement',
                    'Ajout d\'articles au panier',
                    'Erreur de calcul de total'
                ];
            } else {
                var options = [];
            }

            options.forEach(function(option) {
                var optionElement = document.createElement('option');
                optionElement.value = option;
                optionElement.textContent = option;
                sousCategorieSelect.appendChild(optionElement);
            });
        }
    </script>
</head>
<body class="text-center">
    <style>
        h2{background-color: white;border-radius: 15px; padding: 10px;}
        .container, .container h2 {background-color: burlywood;}
        .container{border: brown solid 3px; border-radius: 15px; position: relative;}
        input[type="email"], .form-control {width: 75%; margin: 0 auto;}
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
        <h1>Contact</h1><br><br>
        <nav>
            <ul>
                <li class="nav-item"><a href="{{ route('accueil') }}" class="nav-link">Accueil</a></li>
                <li class="nav-item"><a href="{{ route('livres') }}" class="nav-link">Livres</a></li>
                <li class="nav-item"><a href="{{ route('panier') }}" class="nav-link" id="panier-link">Panier</a></li>
                <li class="nav-item"><a href="{{ route('apropos') }}" class="nav-link">A propos</a></li>
                <li class="nav-itema"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
            </ul>
        </nav>
    </header>
    
    <br><br>
    <div class="container">
        <h2>Si vous avez des questions, contactez-nous</h2>
    </div><br><br><br>
    
    <div class="container" id="c2">
        <h2 class="text-center">Formulaire de Demande</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.envoyer') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Adresse Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div><br>

            <div class="form-group">
                <label for="categorie">Catégorie de la demande</label>
                <select class="form-control" id="categorie" name="categorie" onchange="updateSousCategorie()" required>
                    <option value="">-- Sélectionnez --</option>
                    <option value="Livres" {{ old('categorie') == 'Livres' ? 'selected' : '' }}>Livres</option>
                    <option value="Compte" {{ old('categorie') == 'Compte' ? 'selected' : '' }}>Compte</option>
                    <option value="Panier" {{ old('categorie') == 'Panier' ? 'selected' : '' }}>Panier</option>
                </select>
                @error('categorie') <small class="text-danger">{{ $message }}</small> @enderror
            </div><br>

            <div class="form-group">
                <label for="sous_categorie">Sous-catégorie de la demande</label>
                <select class="form-control" id="sous_categorie" name="sous_categorie" required>
                    <option value="">-- Sélectionnez --</option>
                </select>
                @error('sous_categorie') <small class="text-danger">{{ $message }}</small> @enderror
            </div><br>

            <div class="form-group">
                <label for="message">Détail de votre demande</label>
                <textarea class="form-control" id="message" rows="3" name="message" required>{{ old('message') }}</textarea>
                @error('message') <small class="text-danger">{{ $message }}</small> @enderror
            </div><br><br>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-danger">Envoyer</button><br><br>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <footer>© 2025 Joubert Quentin<br>Droits réservés</footer>
</body>
</html>

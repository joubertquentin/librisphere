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
    <title>Accueil</title>
</head>

<body class="text-center">
    <style>
        h2 {
            background-color: white;
            border-radius: 15px;
            padding: 10px;
        }

        .container h2 {
            background-color: burlywood;
            border: 3px solid brown;
        }

        .container {
            padding-left: 0px;
            padding-right: 0px;
        }

        .col h2 {
            border: none;
        }

        .col {
            background-color: burlywood;
            border-color: brown;
        }
    </style>
    <header>
        <p
            style="position: absolute; top: 10px; left: 10px; z-index: 1000; background-color: blue; padding: 10px; border-radius: 10px;">
            <b>Bienvenue, {{ $prenom }} {{ $nom }}</b>
        </p>


        <form action="{{ route('deconnexion') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger"
                style="position: absolute; top: 10px; right: 10px; z-index: 1000;">Déconnexion</button>
        </form>
        <h1>Accueil du site</h1><br><br>

        <nav>
            <ul>
                <li class="nav-itema"><a href="{{ route('accueil') }}" class="nav-link">Accueil</a></li>
                <li class="nav-item"><a href="{{ url('/livres') }}" class="nav-link">Livres</a></li>
                <li class="nav-item"><a href="{{ url('/panier') }}" class="nav-link" id="panier-link">Panier</a></li>
                <li class="nav-item"><a href="{{ url('/apropos') }}" class="nav-link">A propos</a></li>
                <li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>

            </ul>
        </nav>
    </header><br>
    <div class="container">
        <h2>Bienvenue sur Librisphère</h2><br><br><br>

        <div class="row">
            <div class="col">
                <br>
                <h2>Des livres achetables en ligne ?</h2><br>
                <img
                    src="https://th.bing.com/th/id/R.db3fd755524b053434105ab390e87a03?rik=YfqIqPOgOR5wMw&riu=http%3a%2f%2fwww.essem-bs.com%2fimg%2fFotolia_3804Alpha63_L.jpg&ehk=dMBsGFMbB3lywihBMz1U6JQg%2fqBmQNJIbNKhLEf%2b8Kw%3d&risl=&pid=ImgRaw&r=0" /><br>
                <br>
                <p>Une large gamme de livres catégorisés et triés à votre dispostion est présente sur le site.</p>
            </div>
            <div class="col" style="margin-left: 15px; margin-right: 15px;">
                <br>
                <h2>Une livraison jusqu'à chez moi ?</h2><br>
                <img
                    src="https://th.bing.com/th/id/R.80f431e1fdd87d6ae1b51022b9f388ce?rik=Js8%2bM1V%2fEkrsaw&pid=ImgRaw&r=0" /><br>
                <br>
                <p>Notre service de livraison peut livrer votre commande jusqu'à chez vous ou jusqu'à un point relais
                    proche de chez vous.</p>
            </div>
            <div class="col">
                <br>
                <h2>Si j'ai des questions, à qui dois-je m'adresser ?</h2><br>
                <img src="https://th.bing.com/th/id/OIP.Vi9txJNP-xOfVn6tr_rmmQHaHa?rs=1&pid=ImgDetMain" /><br>
                <br>
                <p>Vous pouvez nous contacter en allant sur la page "Contact", vous devrez par la suite entrer certaines
                    informations pour que nous puissions répondre au mieux à vos demandes.</p>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <footer>© 2025 Joubert Quentin<br>Droits réservés</footer>
</body>

</html>
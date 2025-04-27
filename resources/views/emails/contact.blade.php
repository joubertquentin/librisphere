<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau message d'un utilisateur</title>
</head>
<body>
    <h2>Nouvelle demande</h2>
    <p><strong>Email :</strong> {{ $data['email'] }}</p>
    <p><strong>Catégorie :</strong> {{ $data['categorie'] }}</p>
    <p><strong>Sous-catégorie :</strong> {{ $data['sous_categorie'] }}</p>
    <p><strong>Message :</strong><br>{{ $data['message'] }}</p>
</body>
</html>

const mix = require('laravel-mix');

// Exemple pour compiler le fichier CSS
mix.css('resources/css/style.css', 'public/css');

// Si tu utilises Sass, tu pourrais aussi ajouter quelque chose comme :
mix.sass('resources/sass/app.scss', 'public/css');

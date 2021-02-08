<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Détail de l'article: Titre</title>
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/custom.min.css" media="screen">
    <link rel="shortcut icon" href="images/favicon.ico">
</head>
<body id="page-top">
<div class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <div class="container">
        <a href="./" class="navbar-brand">Accueil de l'administration</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link disabled text-white">Vous êtes connecté avec le login <?=$_SESSION['theUserLogin']?></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="?create">Créer un nouvel article</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="?disconnect">Déconnexion</a>
                </li>
            </ul>

        </div>

    </div>
</div>

<div class="container">

    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12 mx-auto">

                    <h1>Détail de l'article: Titre</h1>
                <hr>
                <h3>Exercice: Ici le détail de l'article</h3>
                <p>Le texte est complet et le retour à la ligne est automatique</p>
                <p>Des boutons ou liens modifier/supprimer avec l'id de l'article sont présents</p>
                <h5>! il doit être impossible d'afficher un article venant d'un autre utilisateur (l'id utilisateur de la session doit correspondre à la clef étrangère de l'article)</h5>
                <p>Pour valider l'affichage et l'effectuer, vous devrez avoir au préalable rempli les modèles <strong>Thenews</strong> (pour l'hydratation et les vérifications avec les setters et l'affichage avec les getters) et <strong>ThenewsManager</strong> (pour la sélection de l'article via son id grâce à une méthode dédiée, SI l'id de l'utilisateur connecté correspond à la clef étrangère d'article!)</p>
                <p>La partie <i>// detail admin article</i> de l'<strong>adminController</strong> devra également être modifié</p>
                <hr>
                <h4> <?= $theNews->getTheNewsTitle() ?></h4>
                <p><?= ThenewsManager::nl2br($theNews->getTheNewsText()) ?></p>
                <h5><a href="?update=<?= $theNews->getIdTheNews() ?>">Modifier</a> | <a
                        href="?delete=<?= $theNews->getIdTheNews() ?>">Supprimer</a></h5>
                <h5>Le <?= $theNews->getTheNewsDate() ?></h5>

                <hr>
                <a href="#page-top">Retour en haut</a>
                <hr>
                <hr>
            </div>

        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tous les articles</title>
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

                    <h1>Tous vos articles</h1>
                <hr>
                <h3>Exercice: Ici la liste d'articles écrite par cet auteur</h3>
                <p>Au format comme les 2 articles ci-dessous, ils sont classés par la date descendante</p>
                <p>Quand on clique sur Lire la suite - modifier/supprimer on a le détail de l'article avec des retours à la ligne automatique!</p>
                <p>On pourra modifier ou supprimer l'article sur le détail de l'article (choix arbitraire)</p>
                <p>Pour créer un nouvel article, le lien se trouve dans le menu du haut</p>
                <p>Pour afficher les articles, vous devrez avoir au préalable remplir les modèles <strong>Thenews</strong> (pour l'hydratation et les vérifications avec les setters et l'affichage grâce aux getters) et <strong>ThenewsManager</strong> (pour la sélection des articles via l'id de l'utilisateur connecté) </p>
                <p>La partie <i>// homepage admin view</i> de l'<strong>AdminController</strong> devra également être modifié</p>
                <hr>
                <?php if (!empty($newsOfUser)) :
                    foreach ($newsOfUser as $item): ?>
                        <h4><?= $item->getTheNewsTitle() ?></h4>
                        <p><?= ThenewsManager::cutTheText($item->getTheNewsText(), 150) ?> ... <a
                                    href="?idarticle=<?= $item->getIdTheNews() ?>">Lire la suite -
                                modifier/supprimer</a></p>
                        <h5>Le <?= $item->getTheNewsDate() ?></h5>
                        <hr>
                    <?php endforeach;
                else : ?>
                    <h3><?= isset($error) ?>></h3>
                <?php endif; ?>
                <a href="#page-top">Retour en haut</a>
                <hr>
            </div>

        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administration: création d'un article</title>
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

                <h1>Administration: modification d'un article</h1>
                <hr>

                <?php
                if(isset($message)):
                    ?>
                    <button type="button" class="btn btn-warning"><?=$message?></button>
                <?php
                endif;
                ?>
                <hr>
                <form action="" method="post">
                    <div class="form-group">
                        <input name="idtheNews" value="<?= $_GET['update'] ?>>" type="hidden">

                        <label for="theNewsTitle">Titre de la news :</label>
                        <input name="theNewsTitle" type="text" class="form-control" value="<?= $theNews->getTheNewsTitle() ?>"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="theNewsText">Texte de la news :</label>
                        <textarea name="theNewsText" class="form-control" cols="20"
                                  rows="10" ><?= $theNews->gettheNewsText() ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="theNewsDate">Date :</label>
                        <input name="theNewsDate" type="date" class="form-control" required id="today">
                    </div>

                    <input name="theUser_idtheUser" value="<?= $_SESSION['idtheUser'] ?>>" type="hidden">


                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
                <hr>
            </div>

        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
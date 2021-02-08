<?php
/*
 * Admin's controller
 */

// Disconnect
if(isset($_GET['disconnect'])){
    if(TheuserManager::disconnectUser()){
        header("Location: ./");
        exit();
    }
}

// create article
if(isset($_GET['create'])){

    // exercice's action
    if (!empty($_POST)) {
        $insert = new Thenews($_POST);

        $recup = $ThenewsManager->insertNews($insert);

        var_dump($recup);
        if ($recup === true) {
            header("Location: ./");
        }
    }

    // form view
    require_once "../view/admin/createAdminView.php";
    exit();
}

// update article
if (isset($_GET['update']) && ctype_digit($_GET['update'])) {

    $theNewsOne = $ThenewsManager->soloNewsById($_GET['update']);
    $theNews = new Thenews($theNewsOne);

    if ($theNews->getTheUser_idtheUser() !== $_SESSION['idtheUser']) {
        header("Location: ./");
    }

    if (!empty($_POST)) {
        var_dump($_POST);
        $newsToUpdate = new Thenews($_POST);
        $update = $ThenewsManager->updateNewsById($newsToUpdate, $_GET['update']);

        if ($update === true) {
            header("Location: ./");
            exit();
        }
    }

    require_once "../view/admin/articleAdminUpdateView.php";
    exit();
}

// delete article
if (isset($_GET['delete']) && ctype_digit($_GET['delete'])) {

    $theNewsOne = $ThenewsManager->soloNewsById($_GET['delete']);
    $theNews = new Thenews($theNewsOne);

    if ($theNews->getTheUser_idtheUser() !== $_SESSION['idtheUser']) {
        header("Location: ./");
    }

    if (isset($_GET['ok'])) {
        $delete = $ThenewsManager->deleteNewsById($_GET['delete']);
        if ($delete === true) {
            header("Location: ./");
            exit();
        }
    }

    require_once "../view/admin/articleAdminDeleteView.php";
    exit();
}

// detail admin article
if(isset($_GET['idarticle'])&&ctype_digit($_GET['idarticle'])){

    // exercice's action
    $recupOneNews = $ThenewsManager->soloNewsById($_GET['idarticle']);
    if(empty($recupOneNews)){
        $error = "Cette news n'exite pas, ou plus";
    }else {
        $theNews = new Thenews($recupOneNews);
    }

    if ($theNews->getTheUser_idtheUser() !== $_SESSION['idtheUser']) {
        header("Location: ./");
    }

    // form view
    require_once "../view/admin/articleAdminView.php";
    exit();
}

$newsForUser = $ThenewsManager->readTheNewsForUser();
if (!empty($newsForUser)) {
    foreach ($newsForUser as $item) {
        $newsOfUser[] = new Thenews($item);
    }

} else {
    $error = "Pas encore de news";
}

// homepage admin view
require_once "../view/admin/indexAdminView.php";
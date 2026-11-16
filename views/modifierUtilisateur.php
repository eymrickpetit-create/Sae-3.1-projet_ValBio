<?php
//ajout autoload
require_once __DIR__ . '/../Classes/autoload.php';
session_start();
// Chargement à la demande d'un classe est automatique
// Ou tout charger si besoin
//loadAllClasses();
if (isset($_SESSION['state']) && $_SESSION['role']==='admin' && $_SESSION['state'] === true) {

}else {
    // Aucune session active ou utilisateur non connecté : on redirige
    header('Location: login.php');
    exit();
}

if(!isset($_POST['login'])){
    header('Location: DonneUser.php');
    exit();
}

if (isset($_POST['valider'])) {
    $user = new Utilisateur([
        'LoginU'     => $_POST['login'],
        'MotDePasse' => $_POST['mdpModif'],
        'RoleUser'   => $_POST['roleModif']
    ]);
    $dao->update($user);               // adaptez au nom réel de votre méthode
    header('Location: DonneUser.php');   // page avec le tableau
    exit();
}

// Sinon : on charge l'utilisateur choisi pour pré-remplir le formulaire
    $dao = new UtilisateurDAO(Bd::getInstance());
    $user = $dao->getOne($_POST['login']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <style type="text/css"></style>
    <link rel="stylesheet" type="text/css" href="../ValBio_gestion.css"/>
    <title>page exemple</title>
</head>

<body>

    <nav  id=top>
        <div id=logo><img src="../img/valBioFull.png" alt ="logo valbio" id=logoHPage></div>
        <div id=le_vide></div>
        <div id=user>
            <?php

            ?>
            <img src="../img/logo_user.webp" alt ="logo user" id=logopersonnel>
        </div>
    </nav>

    <div class="barre_gauche">
        <form method="post" >
            <input type="hidden">
            <button type="submit" formaction="planningAdmin.php">
                <span>Planning</span><br>
                Accéder au planning complet
            </button>
            <br>
            <button type="submit" formaction="AdministrationBd.php">
                <span>Base de données</span><br>
                Accéder aux modifications des données
            </button>
        </form>
    </div>

    <nav class="mainModif">
        <form method="post">
            <input type="hidden" name="login" value="<?= htmlspecialchars($user->LoginU) ?>">

            <label for="mdpModif">Mot de passe :</label>
            <input type="text" id="mdpModif" name="mdpModif" required maxlength="50"
            value="<?= htmlspecialchars($user->MotDePasse) ?>">

            <label for="roleModif">Rôle :</label>
            <input type="text" id="roleModif" name="roleModif" required maxlength="50"
            value="<?= htmlspecialchars($user->RoleUser) ?>">

            <button type="submit" name="valider">Valider modifications</button>
        </form>
    </nav>




    <nav  id=bottom>
        <div id=logo></div>
            <p>
                Paramètres de l'application
            </p>
        <div id=le_vide></div>
    </nav>
</body>
</html>

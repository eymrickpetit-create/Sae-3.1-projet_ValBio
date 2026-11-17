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
    $dao = new UtilisateurDAO(Bd::getInstance());

    if(($_POST['mdpModif'] ?? '')===''){
        $user = $dao->getOne($_POST['login']);
        $_POST['mdpModif']=$user->getMotDePasseHash();
    }

    $user = new Utilisateur([
        'LoginU'     => $_POST['login'],
        'NomU'       => $_POST['nomModif'],
        'MotDePasse' => password_hash($_POST['nomModif'], PASSWORD_DEFAULT),
        'RoleUser'   => $_POST['roleModif']
    ]);
    $dao->update($user);              
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
    <title>modification données <?= $user->getNom()?></title>
</head>

<body>

    <nav  id=top>
        <div id=logo>
            <form method="post" action="ChooseDashBoard.php">
                <button type="submit">
                    <img src="../img/valBioFull.png" alt ="logo valbio" id=logoHPage>
                </button>
            </form>
        </div>
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

            <label for="nomModif">Nom :</label>
            <input type="text" id="nomModif" name="nomModif" required maxlength="50"
            value="<?= htmlspecialchars($user->NomU) ?>">

            <label for="mdpModif">Mot de passe :</label>
            <input type="text" id="mdpModif" name="mdpModif" maxlength="50"
            value="" placeholder="vide si non changé">

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

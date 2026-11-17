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
    $dao  = new UtilisateurDAO(Bd::getInstance());
    $admin = $dao->getOne(trim($_SESSION['user_id']));
    
    if($admin->verifierMotDePasse($_POST['mdp'])){
       
        $user = $dao->getOne(trim($_POST['login']));
        
        $dao->delete($user);      
        header('Location: DonneUser.php');   // page avec le tableau
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <style type="text/css"></style>
    <link rel="stylesheet" type="text/css" href="../ValBio_gestion.css"/>
    <?php $dao = new UtilisateurDAO(Bd::getInstance());
    $pers = $dao->getOne($_POST['login'])?>
    <title>suppression données <?= $pers->getNom()?></title>
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
            <?= $_SESSION['nomU'];

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
                <input type="hidden" id="login" name="login" value="<?= htmlspecialchars(trim($_POST['login'] ?? ''), ENT_QUOTES) ?>">
                <label for="mdp">Mot de passe :</label>
                <input type="password" id="mdp" name="mdp" maxlength="50"value="" required placeholder="comfirmer votre mot de passe">
                <button type="submit" name="valider">Valider suppression</button>
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
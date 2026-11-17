<?php
require_once __DIR__ . '/../Classes/autoload.php';

session_start();
$error = '';

if (isset($_SESSION['state']) && $_SESSION['role']==='admin' && $_SESSION['state'] === true) {

}else {
    // Aucune session active ou utilisateur non connecté : on redirige
    header('Location: login.php');
    exit();
}
    $NoPres    = $_POST['NoPres'] ?? '' ;
    $type = $_POST['TypePres'] ?? '';
    $addr  = $_POST['AddPres'] ?? '';
    $code = $_POST['CodePres'] ?? '';
    $loc = $_POST['LocPres'] ?? '';
    $tel = $_POST['TelPres'] ?? '';

    
    if (strlen($type) !== 1) {
        $error = 'le type prescripteur se represente avec une seul lettre';
    } elseif (strlen($tel)!==10) {
        $error = 'un telephone doit avoir 10 chiffres';
    } else {
    $dao = new PrescripteurDAO(Bd::getInstance());
    try {
        $dao->getOne($NoPres);
        $error = 'Prescriptteur existe deja';
    } catch (OutOfBoundsException $e) {
        $dao->insert($pres);
        header('Location: DonnePres.php');
        exit;
    }
    }



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="../ValBio_gestion.css"/>
    <title>création de compte</title>
</head>
<body>

    <nav id=top>
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
            <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">

            <label for="login">Login</label>
            <input type="text" id="login" name="login" required maxlength="50" autocomplete="username">

            <label for="nomU">nom</label>
            <input type="text" id="nomU" name="nomU" required maxlength="100" autocomplete="complete name">

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required autocomplete="new-password">

            <label for="confirm">Confirmation</label>
            <input type="password" id="confirm" name="confirm" required autocomplete="new-password">

            <label for="role">role du user</label>
            <input type="text" id="role" name="role" required autocomplete="role">

            <button>Créer le compte</button>
            <p><?= htmlspecialchars($error) ?></p>
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
<?php
require_once __DIR__ . '/../Classes/autoload.php';

session_start();
$error = '';

if (isset($_SESSION['state']) && ($_SESSION['role']==='admin' || $_SESSION['role']==='secretaire')&& $_SESSION['state'] === true) {

}else {
    // Aucune session active ou utilisateur non connecté : on redirige
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $IdPa = $_POST['IdPa'] ?? '';
    $NoSS = $_POST['NoSS'] ?? '';
    $NomPa = $_POST['NomPa'] ?? '';
    $PrenomPa = $_POST['PrenomPa'] ?? '';
    $SexePa = $_POST['SexePa'] ?? '';
    $NomUsagePa = $_POST['NomUsagePa'] ?? '';
    $AdressePa = $_POST['AdressePa'] ?? '';
    $CodePa = $_POST['CodePa'] ?? '';
    $LocalitePa = $_POST['LocalitePa'] ?? '';
    $TelephonePa = $_POST['TelephonePa'] ?? '';
    $DateNaissPa = $_POST['DateNaissPa'] ?? '';
    $ValidDroitPa = $_POST['ValidDroitPa'] ?? '';
    $ResteChargePrctPa = $_POST['ResteChargePrctPa'] ?? '';
    
    if (strlen($NoSS) !== 15) {
    $error = 'le numero de securite sociale doit avoir 15 caracteres';
} elseif (strlen($SexePa) !== 1) {
    $error = 'le sexe se represente avec une seule lettre';
} elseif (strlen($CodePa) !== 5) {
    $error = 'le code postal doit avoir 5 chiffres';
} elseif (strlen($TelephonePa) !== 10) {
    $error = 'un telephone doit avoir 10 chiffres';
} elseif (!is_numeric($ResteChargePrctPa)) {
    $error = 'le reste a charge doit etre un nombre';
} else {
    $dao = new PatientDAO(Bd::getInstance());
    try {
        $dao->getOneByNoSS($NoSS);
        $error = 'Patient existe deja';
    } catch (OutOfBoundsException $e) {
        $pa = 
        header('Location: DonneCli.php');
        exit;
    }
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
            <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?? '' ?>">

            <label for="NomPres">Nom complet :</label>
            <input type="text" id="NomPres" name="NomPres" required maxlength="50" autocomplete="off">

            <label for="TypePres">Type prescripteur (1 lettre) :</label>
            <input type="text" id="TypePres" name="TypePres" required maxlength="1" autocomplete="off">

            <label for="AddPres">Adresse :</label>
            <input type="text" id="AddPres" name="AddPres" autocomplete="off">

            <label for="CodePres">Code postal :</label>
            <input type="text" id="CodePres" name="CodePres" autocomplete="off">

            <label for="LocalitePres">Ville :</label>
            <input type="text" id="LocalitePres" name="LocalitePres" autocomplete="off">

            <label for="TelPres">Téléphone (10 chiffres) :</label>
            <input type="text" id="TelPres" name="TelPres" maxlength="10" autocomplete="off">

            <button type="submit">Créer le prescripteur</button>
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
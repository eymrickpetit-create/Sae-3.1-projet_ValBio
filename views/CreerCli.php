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
        $pa = Patient::creer( $noSS,$nomPa,$prenomPa,$sexePa,$nomUsagePa,$adressePa,$codePa, $localitePa,$telephonePa,$dateNaissPa,$professionPa,$validDroitPa,$resteChargePrctPa);
        $dao->insert($pa);
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
            <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

            <label for="NoSS">Numéro de sécurité sociale :</label>
            <input type="text" id="NoSS" name="NoSS" required maxlength="15" autocomplete="off">

            <label for="NomPa">Nom :</label>
            <input type="text" id="NomPa" name="NomPa" required maxlength="50" autocomplete="off">

            <label for="PrenomPa">Prénom :</label>
            <input type="text" id="PrenomPa" name="PrenomPa" required maxlength="50" autocomplete="off">

            <label for="SexePa">Sexe :</label>
            <select id="SexePa" name="SexePa" required autocomplete="off">
                <option value="">-- Choisir --</option>
                <option value="M">Masculin (M)</option>
                <option value="F">Féminin (F)</option>
            </select>

            <label for="NomUsagePa">Nom d'usage :</label>
            <input type="text" id="NomUsagePa" name="NomUsagePa" maxlength="50" autocomplete="off">

            <label for="AdressePa">Adresse :</label>
            <input type="text" id="AdressePa" name="AdressePa" autocomplete="off">

            <label for="CodePa">Code postal :</label>
            <input type="text" id="CodePa" name="CodePa" maxlength="10" autocomplete="off">

            <label for="LocalitePa">Ville :</label>
            <input type="text" id="LocalitePa" name="LocalitePa" autocomplete="off">

            <label for="TelephonePa">Téléphone :</label>
            <input type="tel" id="TelephonePa" name="TelephonePa" maxlength="15" autocomplete="off">

            <label for="DateNaissPa">Date de naissance :</label>
            <input type="date" id="DateNaissPa" name="DateNaissPa" required autocomplete="off">

            <label for="ValidDroitPa">Validité des droits :</label>
            <input type="date" id="ValidDroitPa" name="ValidDroitPa" autocomplete="off">

            <label for="ResteChargePrctPa">Reste à charge (%) :</label>
            <input type="number" id="ResteChargePrctPa" name="ResteChargePrctPa" step="0.01" min="0" max="100" autocomplete="off">
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
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $NomPres = trim($_POST['NomPres'] ?? '');
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
        $dao->getOneByPhone($tel);
        $error = 'Prescriptteur existe deja';
    } catch (OutOfBoundsException $e) {
        $pres = Prescripteur::creerFirst($NomPres, $type, $addr, $code, $loc, $tel);
        $dao->insert($pres);
        header('Location: DonnePres.php');
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

            <label for="locPres">Ville :</label>
            <input type="text" id="locPres" name="locPres" autocomplete="off">

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
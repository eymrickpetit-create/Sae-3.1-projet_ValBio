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

if(!isset($_POST['NoPres'])){
    header('Location: DonnePres.php');
    exit();
} 

if (isset($_POST['valider'])) {
    $dao = new PrescripteurDAO(Bd::getInstance());

    $pres = new Prescripteur([
        'NoPrecripteur'     => $_POST['NoPres'],
        'TypePrescripteur'  => $_POST['TypePres'],
        'AdressePres'       => $_POST['AddPres'],
        'nomPres'           => $_POST['NomPres'],
        'CodePres'          => $_POST['CodePres'], 
        'LocalitePres'      => $_POST['LocPres'], 
        'TelephonePres'     => $_POST['TelPres']

    ]);
    $dao->update($pres);              
    header('Location: DonnePres.php');   // page avec le tableau
    exit();
}

// Sinon : on charge l'utilisateur choisi pour pré-remplir le formulaire
    $dao = new PrescripteurDAO(Bd::getInstance());
    $pres = $dao->getOne($_POST['NoPres']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <style type="text/css"></style>
    <link rel="stylesheet" type="text/css" href="../ValBio_gestion.css"/>
    <title>modification données <?= $pres->getNom()?></title>
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
            <input type="hidden" name="NoPres" value="<?= htmlspecialchars($pres->getNo()) ?>">

            <label for="NomPres">Nom :</label>
            <input type="text" id="NomPres" name="NomPres" required maxlength="50"
            value="<?= htmlspecialchars($pres->getNom()) ?>">

            <label for="TypePres">Type prescripteur :</label>
            <input type="text" id="TypePres" name="TypePres" maxlength="50"
            value="<?= htmlspecialchars($pres->getType()) ?>">

            <label for="CodePres">Code postale :</label>
            <input type="text" id="CodePres" name="CodePres" required maxlength="10"
            value="<?= htmlspecialchars($pres->getCode()) ?>">

            <label for="AddPres">Adresse :</label>
            <input type="text" id="AddPres" name="AddPres" required maxlength="100"
            value="<?= htmlspecialchars($pres->getAddr()) ?>">

            <label for="LocPres">localité :</label>
            <input type="text" id="LocPres" name="LocPres" required maxlength="100"
            value="<?= htmlspecialchars($pres->getLoc()) ?>">

            <label for="TelPres">Téléphone :</label>
            <input type="text" id="TelPres" name="TelPres" required maxlength="10"
            value="<?= htmlspecialchars($pres->getTel()) ?>">

            

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

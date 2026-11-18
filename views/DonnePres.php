<?php

// page de création hors site final

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
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <style type="text/css"></style>
    <link rel="stylesheet" type="text/css" href="../ValBio_gestion.css"/>
    <title>données prescripteurs</title>
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

     <div class=barre_gauche>
        <form method="post" >
            <input type="hidden">
            <button type="submit" formaction="planningAdmin.php">
                <span>Planning</span><br>
                Accéder au planning complet
            </button> <br>

            <button type="submit" formaction="AdministrationBd.php">
                <span>Base de données</span><br>
                Accéder aux modifications des données
            </button>
            <div class="nav-arrow">
                <svg><!-- Votre icône de flèche --></svg>
            </div>
        </form>
    </div>

    <nav classe ="centraladminbd" >
        <h3>Données des prescripteurs</h3>

        <div class="tableau-defilant">
            <form method="post">
                <table>
                    <thead>
                        <tr>
                            <th> </th>
                            <th>N°rescripteur</th>
                            <th>Type de prescripteur</th>
                            <th>Nom du prescripteur</th>
                            <th>Adresse prescripteur</th>
                            <th>Code postal</th>
                            <th>Localité</th>
                            <th>Téléphone</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $dao = new PrescripteurDAO(Bd::getInstance());
                        $prescripteurs = $dao->getAll();
                        foreach ($prescripteurs as $d): 
                            $idPrescripteur = htmlspecialchars($d->NoPrecripteur);
                            $id = "prescripteur_" . $idPrescripteur; // sera affiché prescripteur_ + no du pres
                        ?>
                            <tr>
                                <td><input type="radio" name="NoPrecripteur" id="<?= $id ?>" value="<?= $idPrescripteur ?>"></td>
                                <td><label for="<?= $id ?>"><?= $idPrescripteur ?></label></td>
                                <td><label for="<?= $id ?>"><?= htmlspecialchars($d->TypePrescripteur) ?></label></td>
                                <td><label for="<?= $id ?>"><?= htmlspecialchars($d->NomPres) ?></label></td>
                                <td><label for="<?= $id ?>"><?= htmlspecialchars($d->AdressePres) ?></label></td>
                                <td><label for="<?= $id ?>"><?= htmlspecialchars($d->CodePres) ?></label></td>
                                <td><label for="<?= $id ?>"><?= htmlspecialchars($d->LocalitePres) ?></label></td>
                                <td><label for="<?= $id ?>"><?= htmlspecialchars($d->TelephonePres) ?></label></td>
                            </tr>
                        <?php endforeach; ?>
                
                    </tbody>
                </table>
                <br>
                <p id="texteExplique"></p>
                
                <input type="submit" formaction="ModifierPres.php" value="modifier prescripteur">
                <input type="submit" formaction="CreerPres.php" value="creer prescripteur">
                <input type="submit" formaction="suppPres.php" value="supprimer prescripteur">
            </form>
        </div>
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

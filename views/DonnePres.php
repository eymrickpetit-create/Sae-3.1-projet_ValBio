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
            <?php

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
            <table>
                <thead>
                    <tr>
                        <th>N°Demandeur</th>
                        <th>Type de demandeur</th>
                        <th>Nom du demandeur</th>
                        <th>Adresse</th>
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
                        echo "<tr>";
                        echo "<td>" . $d->NoPrecripteur . "</td>";
                        echo "<td>" . $d->TypePrescripteur . "</td>";
                        echo "<td>" . $d->nomPres . "</td>";
                        echo "<td>" . $d->AdressePres . "</td>";
                        echo "<td>" . $d->CodePres . "</td>";
                        echo "<td>" . $d->LocalitePres . "</td>";
                        echo "<td>" . $d->TelephonePres . "</td>";
                        echo "</tr>";
                    endforeach;
                ?>
                </tbody>
            </table>
        </div>
        <div>
            <form  method="post"  > 
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

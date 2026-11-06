<?php
//ajout autoload
require_once __DIR__ . '/../Classes/autoload.php';

// Chargement à la demande d'un classe est automatique
// Ou tout charger si besoin
//loadAllClasses();
// if (isset($_SESSION['state']) && $_SESSION['state'] === true) {

// }else {
//     // Aucune session active ou utilisateur non connecté : on redirige
//     header('Location: login.php');
//     exit();
// }
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
        <div id=logo><img src="img/valBioFull.png" alt ="logo valbio" id=logoHPage></div>
        <div id=le_vide></div>
        <div id=user>
            <?php

            ?>
            <img src="img/logo_user.webp" alt ="logo user" id=logopersonnel>
        </div>
    </nav>

    <nav class="sidebar">
        <form>
            <input type=submit id="planning" value="">
        </form>
        <h2>Base de données </h2>
        <p> Accéder à la modifications des données</p>
        <div class="nav-arrow">
            <svg><!-- Votre icône de flèche --></svg>
         </div>
    </nav>

    <nav classe ="centraladminbd" >
        <h3>Données des demandeurs</h3>

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
                $demandeurs = new PrescripteurDAO(Bd::getInstance());
                $lesDemandeurs = $demandeurs->getAll();
                    foreach ($lesDemandeurs as $d): 
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
            <input type="submit" formaction="modifDem.php" value="modifier">
            <input type="submit" formaction="creeDem.php" value="creer un demandeur">
            <input type="submit" formaction="suppDem.php" value="supprimer un demandeur">
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

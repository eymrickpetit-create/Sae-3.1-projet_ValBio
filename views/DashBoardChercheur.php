<?php
//ajout autoload
require_once __DIR__ . '/../Classes/autoload.php';
session_start();

//Chargement à la demande d'un classe est automatique
//Ou tout charger si besoin
//loadAllClasses();

if (isset($_SESSION['state']) && $_SESSION['state'] === true) {

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
    <title>acceuil chercheur</title>
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
        <form method="post">
        <button type="submit" formaction="DossAnaCher.php">
            <span>Dossiers analyses</span><br>
            Accéder aux dossiers
        </button><br>
        <button type="submit" formaction="planningCher.php">
            <span>Planning</span><br>
            Accéder au planning complet
        </button>
    </div>

    <div class=mainpanel>
        <h4>Aperçu du planning d'aujourd'hui :</h4>
        <?php

        ?>
    </div>


    <nav  id=bottom>
        <div id=text></div>
            <p>
                Paramètres de l'application
            </p>
        <div id=le_vide></div>
    </nav>
</body>
</html>
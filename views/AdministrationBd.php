<?php
//ajout autoload
require_once __DIR__ . '/../Classes/autoload.php';
session_start();

//Chargement à la demande d'un classe est automatique
//Ou tout charger si besoin
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
    <title>page exemple</title>
</head>

<body>

    <nav  id="top">
        <div id=logo>
            <form method="post" action="ChooseDashBoard.php">
                <button type="submit">
                    <img src="../img/valBioFull.png" alt ="logo valbio" id=logoHPage>
                </button>
            </form>
        </div>
        <div id="le_vide"></div>
        <div id="user">
            <?php

            ?>
            <img src="../img/logo_user.webp" alt="logo user" id="logopersonnel">
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

    <nav class ="centraladminbd" >
    <h3>Quelles données souhaitez vous consulter ?</h3>
    <form  method="post"  > 
    <p id="texteExpliq"></p>
    <input type="submit" formaction="DonneUser.php" value="Données des utilisateurs">
    <input type="submit" formaction="DonneDem.php" value="Données des demandeurs">
    <input type="submit" formaction="DonneCli.php" value="Données des patients">
    <input type="submit" formaction="DonneAna.php" value="Données des analyses">
    <input type="submit" formaction="DonneOrdRes.php" value="Données des ordonnances et résultats">
    </form>
    </nav> 



    <nav  id="bottom">
        <div id="logo2"></div>
            <p>
                Paramètres de l'application
            </p>
        <div id="le_vide2"></div>
    </nav>
</body>
</html>

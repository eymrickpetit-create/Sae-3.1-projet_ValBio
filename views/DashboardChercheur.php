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
    <link rel="stylesheet" type="text/css" href="ValBio_gestion.css"/>
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

    <div class=barre_gauche>
        <section>
            <h3>Dossiers analyses</h3>
            <p>Accéder aux dossiers</p>
        </section>
        <section>
            <h3>Planning</h3>
            <p>Accéder au planning complet</p>
        </section>
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

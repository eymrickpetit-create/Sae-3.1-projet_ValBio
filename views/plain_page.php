<?php
//ajout autoload
require_once __DIR__ . '/autoload.php';
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
#----------------------- Barre de navigation haut -------------------------


    <nav  id=top>
        <div id=logo><img src="img/valBioFull.png" alt ="logo valbio" id=logoHPage></div>
        <div id=le_vide></div>
        <div id=user>
            <?php

            ?>
            <img src="img/logo_user.webp" alt ="logo user" id=logopersonnel>
        </div>
    </nav>

#----------------------- Barre latérale avec choix des options -------------------------

    <div class=barre_gauche>
        <section>
            <h3>Dossiers patients</h3>
            <p>Accéder aux dossiers</p>
        </section>
        <section>
            <h3>Dossiers prescripteurs</h3>
            <p>Accéder aux dossiers</p>
        </section>
        <section>
            <h3>Dossiers analyses</h3>
            <p>Accéder aux dossiers</p>
        </section>
        <section>
            <h3>Planning</h3>
            <p>Accéder au planning complet</p>
        </section>
        <section>
            <h3>Base de données</h3>
            <p>Accéder à la modification des données</p>
        </section>
    </div>


#----------------------- Fenetre centrale -------------------------


    <div class=mainpanel>

    </div>

#----------------------- Barre de menu bas -------------------------

    <nav  id=bottom>
        <div id=text></div>
            <p>
                Paramètres de l'application
            </p>
        <div id=le_vide></div>
    </nav>
</body>
</html>

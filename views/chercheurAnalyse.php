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
    <title>analyses chercheur</title>
</head>

<body>

    <nav  id=top>
        <div id=logo><img src="../img/valBioFull.png" alt ="logo valbio" id=logoHPage></div>
        <div id=le_vide></div>
        <div id=user>
            <?php

            ?>
            <img src="../img/logo_user.webp" alt ="logo user" id=logopersonnel>
        </div>
    </nav>

    <div class=barre_gauche>
        <form method="post">
        <button type="submit" formaction="chercheurAnalyse.php">
            <span>Dossiers analyses</span><br>
            Accéder aux dossiers
        </button><br>
        <button type="submit" formaction="planningCher.php">
            <span>Planning</span><br>
            Accéder au planning complet
        </button>
    </div>

    <div class=mainpanel>
        <?php
        echo "<select name='Analyses' id='analyse_select'>";
        $stmt=$this->pdo->prepare("SELECT NoAnalyse, NomAnalyse from analyseMed join contenir using(NoAnalyse) join examen using(NoExamen) order by DateOrdonnance asc limit 20");
        foreach ($utilisateur->$stmt as $f) { 
            echo "<option value=", $f->NoAnalyse,">",$f->NoAnalyse, $f->NomAnalyse,"</option>\n";
        }
        echo "</select>"
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
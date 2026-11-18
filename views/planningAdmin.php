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
    <title>planning complet administration</title>
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

    <div class=mainpanel>
        <?php
        echo "<select name='roleUtilisateur' id='role_select'>";
        foreach ($utilisateur->getRole() as $f) {
            echo "<option value=", $f->RoleUser,">",$f->RoleUser, "</option>\n";
        }
        echo "</select>";
        echo "select name='nomUtilisateur' id='nom_select'";
        foreach ($utilisateur->getNom() as $f) {
            echo "<option value=", $f->nomU,">",$f->nomU, "</option>\n";
        }
        echo "</select>";
        ?>
    </div>

    <nav  id=bottom>
        <div id=logo></div>
            <p>
                Paramètres de l'application
            </p>
        <div id=le_vide></div>
    </nav>

</body>
</html>
    
<?php
//ajout autoload
require_once __DIR__ . '/../autoload.php';

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
        <h3>Données des utilisateurs</h3>

        <div>
            <form method="post">
                <table>
                    <thead>
                        <tr>
                        <th></th>
                        <th>Login</th>
                        <th>Mot de passe</th>
                        <th>Rôle</th>
                        </tr>
                    </thead>
                <tbody>
                    <?php
                        $users = new utilisateurDAO(Bd::getInstance());
                        $lesusers = $users->getAll();
                        foreach ($lesusers as $i => $u):
                        $id = "u" . $i;
                        $login = htmlspecialchars($u->LoginU);
                    ?>
                        <tr>
                        <td><input type="radio" name="login" id="<?= $id ?>" value="<?= $login ?>"></td>
                        <td><label for="<?= $id ?>"><?= $login ?></label></td>
                        <td><label for="<?= $id ?>"><?= htmlspecialchars($u->MotDePasse) ?></label></td>
                        <td><label for="<?= $id ?>"><?= htmlspecialchars($u->RoleUser) ?></label></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>

                <p id="texteExplique"></p>

                <input type="submit" formaction="modifier.php" value="modifier">
                <input type="submit" formaction="creeUser.php" value="créer un utilisateur" formnovalidate>
                <input type="submit" formaction="suppUser.php" value="supprimer un utilisateur">
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

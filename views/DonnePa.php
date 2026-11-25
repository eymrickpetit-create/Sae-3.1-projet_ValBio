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
    <title>données Patients</title>
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
        <h3>Données des patients</h3>

        <div class="tableau-defilant">
            <form method="post">
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>N° Patient</th>
                            <th>N° Sécurité Sociale</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Sexe</th>
                            <th>Nom d'usage</th>
                            <th>Adresse</th>
                            <th>Code postal</th>
                            <th>Localité</th>
                            <th>Téléphone</th>
                            <th>Date de naissance</th>
                            <th>Profession</th>
                            <th>Validité droits</th>
                            <th>Reste à charge (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dao = new PatientDAO(Bd::getInstance());
                        $patients = $dao->getAll();

                        foreach ($patients as $d):
                            $idPa = (int) $d->getIdentifiantPa();
                            $idPaSafe = htmlspecialchars((string) $idPa, ENT_QUOTES, 'UTF-8');
                            $inputId = 'patient_' . $idPa;
                        ?>
                            <tr>
                                <td>
                                    <input type="radio" name="identifiantPa" id="<?= $inputId ?>" value="<?= $idPaSafe ?>">
                                </td>
                                <td><label for="<?= $inputId ?>"><?= $idPaSafe ?></label></td>
                                <td><label for="<?= $inputId ?>"><?= htmlspecialchars($d->getNoSS(), ENT_QUOTES, 'UTF-8') ?></label></td>
                                <td><label for="<?= $inputId ?>"><?= htmlspecialchars($d->getNomPa(), ENT_QUOTES, 'UTF-8') ?></label></td>
                                <td><label for="<?= $inputId ?>"><?= htmlspecialchars($d->getPrenomPa(), ENT_QUOTES, 'UTF-8') ?></label></td>
                                <td><label for="<?= $inputId ?>"><?= htmlspecialchars($d->getSexePa(), ENT_QUOTES, 'UTF-8') ?></label></td>
                                <td><label for="<?= $inputId ?>"><?= htmlspecialchars($d->getNomUsagePa() ?? '', ENT_QUOTES, 'UTF-8') ?></label></td>
                                <td><label for="<?= $inputId ?>"><?= htmlspecialchars($d->getAdressePa(), ENT_QUOTES, 'UTF-8') ?></label></td>
                                <td><label for="<?= $inputId ?>"><?= htmlspecialchars($d->getCodePa(), ENT_QUOTES, 'UTF-8') ?></label></td>
                                <td><label for="<?= $inputId ?>"><?= htmlspecialchars($d->getLocalitePa(), ENT_QUOTES, 'UTF-8') ?></label></td>
                                <td><label for="<?= $inputId ?>"><?= htmlspecialchars($d->getTelephonePa(), ENT_QUOTES, 'UTF-8') ?></label></td>
                                <td>
                                    <label for="<?= $inputId ?>">
                                        <?php
                                        $dateNaiss = $d->getDateNaissPa();
                                        $dateNaissStr = $dateNaiss instanceof DateTimeInterface ? $dateNaiss->format('Y-m-d') : (string) $dateNaiss;
                                        echo htmlspecialchars($dateNaissStr, ENT_QUOTES, 'UTF-8');
                                        ?>
                                    </label>
                                </td>
                                <td><label for="<?= $inputId ?>"><?= htmlspecialchars($d->getProfessionPa(), ENT_QUOTES, 'UTF-8') ?></label></td>
                                <td>
                                    <label for="<?= $inputId ?>">
                                        <?php
                                        $validDroit = $d->getValidDroitPa();

                                        if ($validDroit instanceof DateTimeInterface) {
                                            $validDroitStr = $validDroit->format('Y-m-d');
                                        } else {
                                            $validDroitStr = trim((string) $validDroit);
                                        }

                                        $affichage = $validDroitStr !== '' ? $validDroitStr : 'non def';
                                        echo htmlspecialchars($affichage, ENT_QUOTES, 'UTF-8');
                                        ?>
                                    </label>
                                </td>
                                <td>
                                    <label for="<?= $inputId ?>">
                                        <?= htmlspecialchars((string) $d->getResteChargePrctPa(), ENT_QUOTES, 'UTF-8') ?>
                                    </label>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <input type="submit" formaction="ModifierPa.php" value="modifier patient">
                <input type="submit" formaction="CreerPa.php" value="creer patient">
                <input type="submit" formaction="suppPa.php" value="supprimer patient">
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

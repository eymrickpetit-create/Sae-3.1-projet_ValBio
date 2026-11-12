<?php
require_once __DIR__ . '/../Classes/autoload.php';

session_start();

if (empty($_SESSION['user_login'])) {
    header('Location: login.php');
    exit;
}

$dao  = new UtilisateurDAO();
$user = $dao->getOne($_SESSION['user_login']);

try {
    $user = $dao->getOne($_SESSION['user_login']);
} catch (OutOfBoundsException $e) {
    session_destroy();
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="../ValBio_gestion.css"/>
    <title>tableau de bord</title>
</head>

<body>
    <header>
        <img src="../img/valBioFull.png" alt="logo valbio" id="logoHPage">
    </header>

    <h1>Bonjour <?= htmlspecialchars($user->getLogin()) ?></h1>
    <a href="logout.php">Déconnexion</a>
</body>
</html>

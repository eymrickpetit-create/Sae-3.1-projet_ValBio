<?php
//ajout autoload
require_once __DIR__ . '/autoload.php';

session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        die('Requête invalide');
    }

    $dao  = new UserDAO();
    $user = $dao->findByLogin($_POST['login'] ?? '');

    if ($user && $user->verifyPassword($_POST['password'] ?? '')) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user->getId();
        header('Location: dashboard.php');
        exit;
    }
    $error = 'Identifiants incorrects';
}

$_SESSION['csrf'] = bin2hex(random_bytes(32));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="ValBio_gestion.css"/>
     <title>connexion</title>
</head>

<body>
    <header>
       <img src="img/valBioFull.png" alt =" logo valbio" id=logoHPage>
       <?php

       ?>
       <img src="img/person.png" alt =" logo valbio" id=logopersonnel>
    </header>
<form method="post">
    <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
    <input type="string" name="login" required>
    <input type="password" name="password" required>
    <button>Connexion</button>
    <p><?= htmlspecialchars($error) ?></p>
</form>

</body>
</html>

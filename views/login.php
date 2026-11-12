<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../Classes/autoload.php';

session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        die('Requête invalide');
    }
    $pdo = MaBD::getInstance();

    $dao  = new UtilisateurDAO($pdo);
    $user = $dao->getOne($_POST['login'] ?? '');

    try {
            $user = $dao->getOne($_POST['login'] ?? '');
    } catch (OutOfBoundsException $e) {
        $user = null;
    }

if ($user && $user->verifierMotDePasse($_POST['password'] ?? '')) {
    // ... le reste ne change pas
}

    if ($user && $user->verifierMotDePasse($_POST['password'] ?? '')) {
        session_regenerate_id(true);
        $_SESSION['user_login'] = $user->getLogin();
        $_SESSION['state'] = true;
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
    <link rel="stylesheet" type="text/css" href="../ValBio_gestion.css"/>
    <title>connexion</title>
</head>

<body>
    <header>
        <img src="../img/valBioFull.png" alt="logo valbio" id="logoHPage">
        <img src="../img/person.png" alt="icône utilisateur" id="logopersonnel">
    </header>

    <form method="post">
        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
        <input type="text" name="login" required autocomplete="username">
        <input type="password" name="password" required autocomplete="current-password">
        <button>Connexion</button>
        <p><?= htmlspecialchars($error) ?></p>
    </form>
</body>
</html>

<?php
require_once __DIR__ . '/../Classes/autoload.php';

session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        die('Requête invalide');
    }

    $login    = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm'] ?? '';

    if ($login === '' || strlen($login) > 50) {
        $error = 'Login invalide (1 à 50 caractères)';
    } elseif (strlen($password) < 8) {
        $error = 'Mot de passe trop court (8 caractères minimum)';
    } elseif ($password !== $confirm) {
        $error = 'Les mots de passe ne correspondent pas';
    } else {
    $dao = new UtilisateurDAO();
    try {
        $dao->getOne($login);
        $error = 'Ce login existe déjà';
    } catch (OutOfBoundsException $e) {
        $dao->insert(Utilisateur::creer($login, $password));
        header('Location: login.php');
        exit;
    }
}
}

$_SESSION['csrf'] = bin2hex(random_bytes(32));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="../ValBio_gestion.css"/>
    <title>création de compte</title>
</head>
<body>
    <form method="post">
        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">

        <label for="login">Login</label>
        <input type="text" id="login" name="login" required maxlength="50" autocomplete="username">

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required autocomplete="new-password">

        <label for="confirm">Confirmation</label>
        <input type="password" id="confirm" name="confirm" required autocomplete="new-password">

        <button>Créer le compte</button>
        <p><?= htmlspecialchars($error) ?></p>
    </form>
</body>
</html>
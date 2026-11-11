<?php
//ajout autoload
require_once __DIR__ . '/../Classes/autoload.php';

// Chargement à la demande d'un classe est automatique
// Ou tout charger si besoin
//loadAllClasses();
session_start();
if (isset($_SESSION['state']) && $_SESSION['state'] === true) {

}else {
    // Aucune session active ou utilisateur non connecté : on redirige
    header('Location: login.php');
    exit();
}

$userdao = new UtilisateurDAO(Bd::getInstace());
$user =  $userdao->getOne($_SESSION['user_id']);

switch($user->RoleUser){
    case "admin" :
        
        
}
?>

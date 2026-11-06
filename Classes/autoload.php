<?php
// Classes/autoload.php

spl_autoload_register(function ($className) {
    // Si la classe utilise des namespaces, on remplace les antislashs par des slashes
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    
    // Chemin vers le dossier Classes (peu importe d'où est appelé l'autoloader)
    $file = __DIR__ . '/' . $className . '.php';
    
    if (file_exists($file)) {
        require_once $file;
    }
});
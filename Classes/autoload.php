<?php

// Dossier contenant les classes
define('CLASSES_DIR', __DIR__ . '/<Classes/');

/** Chargement à la demande */
spl_autoload_register(function (string $class) {
    // Ne garde que le nom de la classe (sans namespace)
    $name = basename(str_replace('\\', '/', $class));
    $file = CLASSES_DIR . $name . '.php';

    if (is_file($file)) {
        require_once $file;
    }
});

/** Charge tous les fichiers du dossier d'un coup */
function loadAllClasses(): void
{
    foreach (glob(CLASSES_DIR . '*.php') as $file) {
        require_once $file;
    }
}
<?php
// Classe de connexion à une base de données
// S'inspire du pattern singleton pour n'ouvrir qu'une seule connexion
// Utilisation :
//    $bd = MaBD::getInstance(); // $bd est un objet PDO
class Bd {

   static private $pdo = null; // Le singleton

   // Obenir le singleton
   static function getInstance(): ?PDO {
      if (self::$pdo == null) {
         // $dsn = "mysql:host=gigondas;dbname=petitpoe;charset=utf8";
         // self::$pdo = new PDO($dsn, "petitpoe", "petitpoe");
         $dsn = "mysql:host=localhost;dbname=petitpoe;charset=utf8";
         self::$pdo = new PDO($dsn, "arleq1", "oct");
      }
      return self::$pdo;
   }
}


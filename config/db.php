<?php

// Configuration BDD
define('DB_HOST', 'localhost');
define('DB_NAME', 'reviews');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

// PHP se connecte au SQL s'il y arrive sinon on renvoie une erreur
try {
    $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // On veut un tableau associatif en résultat
    ]);
} catch (Exception $exception) {
    echo '<h1>'.$exception->getMessage().'</h1>';
    echo '<img src="img/travolta.gif">';
    die; // On arrête le code PHP
}

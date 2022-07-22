<?php

/**
 * Permet de récupèrer facilement un champ en POST
 */
function post($field) {
    return sanitize($_POST[$field] ?? null);
}

/**
 * Permet de récupèrer facilement un fichier uploadé.
 */
function pfile($field) {
    return $_FILES[$field] ?? null;
}

/**
 * Permet de nettoyer une valeur
 */
function sanitize($value) {
    return trim(htmlspecialchars($value));
}

/**
 * Permet de vérifier si un formulaire est soumis.
 */
function isSubmit() {
    return !empty($_POST);
}

/**
 * Permet de faire un insert en SQL.
 */
function insert($sql, $bindings = []) {
    // global permet d'accèder à une variable extérieure à la fonction
    global $db;

    return $db->prepare($sql)->execute($bindings);
}

/**
 * Permet de faire un select en SQL.
 */
function select($sql) {
    global $db;

    return $db->query($sql)->fetchAll();
}

/**
 * Permet d'uploader un fichier.
 */
function upload($file, $name, $folder) {
    if (!is_dir($folder)) {
        mkdir($folder);
    }

    // Jean Paul devient jean-paul.pdf
    $name = str_replace(' ', '-', strtolower($name));
    $path = pathinfo($file['name']);
    $filename = $name.'-'.md5(uniqid()).'.'.$path['extension'];

    move_uploaded_file($file['tmp_name'], $folder.'/'.$filename);

    return $filename;
}

function dateToFrench($date, $format) 
{
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date) ) ) );
}
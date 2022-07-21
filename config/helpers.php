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

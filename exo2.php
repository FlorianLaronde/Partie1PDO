<?php

$dsn = 'mysql:host=localhost;dbname=colyseum';
$login = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

try {
    $sql = 'SELECT `type`
    FROM `showtypes`';
    $result = $pdo->query($sql);
    $allShowTypes = $result->fetchAll();
} catch (PDOException $e) {
    echo 'La requête a retourné une erreur';
}

?>
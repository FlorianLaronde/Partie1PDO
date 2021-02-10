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

$sql = 'SELECT `lastName`, `firstName`, `birthDate`
FROM `clients` 
WHERE `card`-1';
$result = $pdo->query($sql);
$allClients = $result->fetchAll();

?>
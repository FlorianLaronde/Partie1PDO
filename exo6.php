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

$sql = 'SELECT `lastName`, `firstName` 
FROM `clients` WHERE `lastName`
ORDER BY `lastName` ASC  
like "M%" ' ;
$result = $pdo->query($sql);
$allClients = $result->fetchAll();

?>
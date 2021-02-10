<?php


// connexion à la bdd
$dsn = 'mysql:host=localhost;dbname=dwwm_colyseum';
$login = 'colyseum';
$password = 'dfyw4hXlAIOPKCUI';

try{
    $pdo = new PDO($dsn, $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Permet de fournir des informations complémentaires lors de la capture des exceptions avec try Catch
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); // Permet de délivrer un jeu de résultats sous forme d'objet.
}
catch(PDOException $e){
   echo 'erreur de connexion à la BDD : '. $e->getMessage();
}


// Afficher tous les clients.
    try{
        $sql = 'SELECT `lastName`, `firstName`, `birthDate` FROM `clients`';
        $result = $pdo->query($sql);
        $allClients = $result->fetchAll();
    }catch(PDOException $e){
        echo 'La requête a retrourné une erreur: '. $e->getMessage();
    }


// Afficher tous les types de spectacles possibles.
    try{
        $sql = 'SELECT `type` FROM `showtypes`';
        $result = $pdo->query($sql);
        $allShowTypes = $result->fetchAll();
    }catch(PDOException $e){
        echo 'La requête a retrourné une erreur: '. $e->getMessage();
    }


// Afficher les 20 premiers clients.
try{
    $sql = 'SELECT `lastName`, `firstName`, `birthDate` FROM `clients` limit 20';
    $result = $pdo->query($sql);
    $first20Clients = $result->fetchAll();
}catch(PDOException $e){
    echo 'La requête a retrourné une erreur: '. $e->getMessage();
}


// N'afficher que les clients possédant une carte de fidélité.
try{
    $sql = 'SELECT `lastName`, `firstName`, `birthDate` FROM `clients` where `card`=1';
    $result = $pdo->query($sql);
    $clientsWithCard = $result->fetchAll();
}catch(PDOException $e){
    echo 'La requête a retrourné une erreur: '. $e->getMessage();
}


// Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre "M".
// Les afficher comme ceci :
// Nom : Nom du client
// Prénom : Prénom du client
try{
    $sql = 'SELECT `lastName`, `firstName` FROM `clients` where `lastName`like "M%" ORDER BY `lastName`';
    $result = $pdo->query($sql);
    $clientsStartM = $result->fetchAll(PDO::FETCH_OBJ);
}catch(PDOException $e){
    echo 'La requête a retrourné une erreur: '. $e->getMessage();
}


// Afficher le titre de tous les spectacles ainsi que l'artiste, la date et l'heure. Trier les titres par ordre alphabétique. Afficher les résultat comme ceci : Spectacle par artiste, le date à heure.
try{
    $sql = 'SELECT `title`, `performer`, `date`, `startTime` FROM `shows` ORDER BY `title`';
    $result = $pdo->query($sql);
    $allShows = $result->fetchAll(PDO::FETCH_OBJ);
}catch(PDOException $e){
    echo 'La requête a retrourné une erreur: '. $e->getMessage();
}


// Afficher tous les clients comme ceci :
// Nom : Nom de famille du client
// Prénom : Prénom du client
// Date de naissance : Date de naissance du client
// Carte de fidélité : Oui (Si le client en possède une) ou Non (s'il n'en possède pas)
// Numéro de carte : Numéro de la carte fidélité du client s'il en possède une.
try{
    $sql = 'SELECT `lastName`, `firstName`, `birthDate`, `cardNumber`, `card`,
            IF(`card` = 1, "oui", "non") as `card`
            FROM `clients`';
    $result = $pdo->query($sql);
    $allClientsFilteredByCard = $result->fetchAll(PDO::FETCH_OBJ);
}catch(PDOException $e){
    echo 'La requête a retrourné une erreur: '. $e->getMessage();
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partie 1 PDO</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    
    <div class="container">

        <!-- Tous les clients -->
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Lastname</th>
                <th scope="col">Firstname</th>
                <th scope="col">BirthDate</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=0;
                    foreach($allClients as $client){
                        $i++;
                        echo "<tr>
                            <th scope=\"row\">$i</th>
                            <td>$client->lastName</td>
                            <td>$client->firstName</td>
                            <td>$client->birthDate</td>
                        </tr>";
                    }
                ?>
                

            </tbody>
        </table>

        <!-- Tous les types de spectacles -->
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Type de spectacle</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=0;
                    foreach($allShowTypes as $showType){
                        $i++;
                        echo "<tr>
                            <th scope=\"row\">$i</th>
                            <td>$showType->type</td>
                        </tr>";
                    }
                ?>
                

            </tbody>
        </table>

        <!-- Afficher les 20 premiers clients. -->
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Lastname</th>
                <th scope="col">Lirstname</th>
                <th scope="col">BirthDate</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=0;
                    foreach($first20Clients as $client){
                        $i++;
                        echo "<tr>
                            <th scope=\"row\">$i</th>
                            <td>$client->lastName</td>
                            <td>$client->firstName</td>
                            <td>$client->birthDate</td>
                        </tr>";
                    }
                ?>
                

            </tbody>
        </table>
        
        <!-- N'afficher que les clients possédant une carte de fidélité. -->
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Lastname</th>
                <th scope="col">Firstname</th>
                <th scope="col">BirthDate</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=0;
                    foreach($clientsWithCard as $client){
                        $i++;
                        echo "<tr>
                            <th scope=\"row\">$i</th>
                            <td>$client->lastName</td>
                            <td>$client->firstName</td>
                            <td>$client->birthDate</td>
                        </tr>";
                    }
                ?>
                

            </tbody>
        </table>
        
        <!-- Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre "M" -->
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Lastname</th>
                <th scope="col">Firstname</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=0;
                    foreach($clientsStartM as $client){
                        $i++;
                        echo "<tr>
                            <th scope=\"row\">$i</th>
                            <td>$client->lastName</td>
                            <td>$client->firstName</td>
                        </tr>";
                    }
                ?>
                

            </tbody>
        </table>
        
        <!-- Afficher le titre de tous les spectacles ainsi que l'artiste, la date et l'heure. Trier les titres par ordre alphabétique. Afficher les résultat comme ceci : Spectacle par artiste, le date à heure. -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titre spectacle</th>
                    <th scope="col">Artiste</th>
                    <th scope="col">Date</th>
                    <th scope="col">Heure</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=0;
                    foreach($allShows as $show){
                        $i++;
                        echo "<tr>
                            <th scope=\"row\">$i</th>
                            <td>$show->title</td>
                            <td>$show->performer</td>
                            <td>$show->date</td>
                            <td>$show->startTime</td>
                        </tr>";
                    }
                ?>
                

            </tbody>
        </table>

        <!-- Afficher tous les clients comme ceci :
        Nom : Nom de famille du client
        Prénom : Prénom du client
        Date de naissance : Date de naissance du client
        Carte de fidélité : Oui (Si le client en possède une) ou Non (s'il n'en possède pas)
        Numéro de carte : Numéro de la carte fidélité du client s'il en possède une. -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Date de naissance</th>
                    <th scope="col">Carte de fidélité</th>
                    <th scope="col">Numéro de carte</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=0;
                    foreach($allClientsFilteredByCard as $client){
                        $i++;
                        echo "<tr>
                            <th scope=\"row\">$i</th>
                            <td>$client->firstName</td>
                            <td>$client->lastName</td>
                            <td>$client->birthDate</td>
                            <td>$client->card</td>
                            <td>$client->cardNumber</td>
                        </tr>";
                    }
                ?>
                

            </tbody>
        </table>


    </div>




</body>
</html>
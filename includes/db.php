<?php

$servername = "localhost";
$username = "distant";
$password = "cisco";
$dbname = "projetA";


$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}



?>

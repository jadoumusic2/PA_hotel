<?php
session_start(); 

if (!isset($_SESSION['email'])) {
    header("Location: connexion.php");
    exit();
}

if ($_SESSION['role'] !== 1 && $_SESSION['role'] !== 2) {
    header("Location: connexion.php");
    exit();
}

include '../includes/db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modifier'])) {
    
    $modify_id = $_POST['modify_id'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $num = $_POST['num'];

    
    $sql = $conn->prepare("UPDATE reservation_offres SET date_debut=?, date_fin=?, prenom=?, nom=?, email=?, nombre=?, num=? WHERE id_reservation=?");
    $sql->bind_param("sssssssi", $date_debut, $date_fin, $prenom, $nom, $email, $nombre, $num, $modify_id);

    if ($sql->execute()) {
        header('Location: offre.php');
    } else {
        echo "Erreur lors de la mise à jour des informations : " . $conn->error;
    }
} else {
    
    header('Location: index.php');
    exit;
}
?>
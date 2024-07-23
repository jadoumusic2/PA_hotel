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
    $nom = $_POST['nom'];
    $numero_telephone = $_POST['numero_telephone'];
    $nombre_personne = $_POST['nombre_personne'];
    $type_reunion = $_POST['type_reunion'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $duree_reservation = $_POST['duree_reservation'];

    
    $sql = $conn->prepare("UPDATE reunion SET nom=?,numero_telephone=?, nombre_personne=?, type_reunion=?, date=?, heure=?, duree_reservation=? WHERE id=?");
    $sql->bind_param("sssssssi", $nom, $numero_telephone, $nombre_personne, $type_reunion, $date, $heure, $duree_reservation, $modify_id);

    if ($sql->execute()) {
        header('Location: reunion.php');
    } else {
        echo "Erreur lors de la mise à jour des informations : " . $conn->error;
    }
} else {
    
    header('Location: index.php');
    exit;
}
?>
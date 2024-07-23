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
    $arrival_days = $_POST['arrival_days'];
    $depart_days = $_POST['depart_days'];
    $number = $_POST['number'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $name = $_POST['name'];

    
    $sql = $conn->prepare("UPDATE suites_a SET arrival_days=?, depart_days=?, number=?, phone_number=?, name=?, email=? WHERE id=?");
    $sql->bind_param("ssssssi", $arrival_days, $depart_days, $number, $phone_number, $name, $email, $modify_id);

    if ($sql->execute()) {
        header('Location: reservation_chambre.php');
    } else {
        echo "Erreur lors de la mise à jour des informations : " . $conn->error;
    }
} else {
    
    header('Location: index.php');
    exit;
}
?>
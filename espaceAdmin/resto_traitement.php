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
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $days = $_POST['days'];
    $hours = $_POST['hours'];
    $number = $_POST['number'];
    

    
    $sql = $conn->prepare("UPDATE reservation_resto SET phone_number=?, name=?, days=?, hours=?, number=?, email=? WHERE id=?");
    $sql->bind_param("ssssssi", $phone_number, $name, $days, $hours, $number, $email, $modify_id);

    if ($sql->execute()) {
        header('Location: resto.php');
    } else {
        echo "Erreur lors de la mise à jour des informations : " . $conn->error;
    }
} else {
    
    header('Location: index.php');
    exit;
}
?>
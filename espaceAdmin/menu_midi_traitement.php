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
    $date = $_POST['date'];
    $entre = $_POST['entre'];
    $plat = $_POST['plat'];
    $fromage = $_POST['fromage'];
    $dessert = $_POST['dessert'];
    $prix_menu = $_POST['prix_menu'];

    
    $sql = $conn->prepare("UPDATE menu_midi SET date=?, entre=?, plat=?, fromage=?, dessert=?, prix_menu=? WHERE id=?");
    $sql->bind_param("ssssssi", $date, $entre, $plat, $fromage, $dessert, $prix_menu, $modify_id);

    if ($sql->execute()) {
        header('Location: menu.php');
    } else {
        echo "Erreur lors de la mise à jour des informations : " . $conn->error;
    }
} else {
    
    header('Location: index.php');
    exit;
}
?>

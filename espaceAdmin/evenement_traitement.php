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
    $titre = $_POST['titre'];
    $image = $_POST['image'];
    $description = $_POST['description'];


    $sql = $conn->prepare("UPDATE evenement SET titre=?, image=?, description=? WHERE id=?");
    $sql->bind_param("sssi", $titre, $image, $description, $modify_id);

    if ($sql->execute()) {
        header('Location: evenement.php');
    } else {
        echo "Erreur lors de la mise à jour des informations : " . $conn->error;
    }
} else {

    header('Location: index.php');
    exit;
}
?>
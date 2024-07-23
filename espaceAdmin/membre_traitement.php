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
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];

    
    $sql = $conn->prepare("UPDATE utilisateurs SET nom=?, prenom=?, telephone=?, email=? WHERE id=?");
    $sql->bind_param("ssssi", $nom, $prenom, $telephone, $email, $modify_id);

    if ($sql->execute()) {
        header('Location: membres.php');
    } else {
        echo "Erreur lors de la mise à jour des informations : " . $conn->error;
    }
} else {
    
    header('Location: index.php');
    exit;
}
?>

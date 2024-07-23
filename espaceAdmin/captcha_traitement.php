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
    $question = $_POST['question'];
    $reponse = $_POST['reponse'];
    

    
    $sql = $conn->prepare("UPDATE captcha SET question=?, reponse=? WHERE id=?");
    $sql->bind_param("ssi", $question, $reponse, $modify_id);

    if ($sql->execute()) {
        header('Location: captcha.php');
    } else {
        echo "Erreur lors de la mise à jour des informations : " . $conn->error;
    }
} else {
    
    header('Location: index.php');
    exit;
}
?>
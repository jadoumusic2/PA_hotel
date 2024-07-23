<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

$connected = (isset($_SESSION['email']) && !empty($_SESSION['email'])) || (isset($_SESSION['mot_de_passe']) && !empty($_SESSION['mot_de_passe']));

$role = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
?>

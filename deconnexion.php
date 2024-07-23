<?php

include 'includes/db.php';

session_start();
$email = $_SESSION['email'];
$session_id = session_id();

$sql_delete = "DELETE FROM connexion WHERE session_id = '$session_id'";
$conn->query($sql_delete);

session_destroy();

header("Location: index.php");
exit();
?>
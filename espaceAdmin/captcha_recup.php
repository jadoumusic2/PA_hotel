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



if(isset($_POST['modify_id'])) {
    $modify_id = $_POST['modify_id'];
    
    
    $sql = $conn->prepare("SELECT question, reponse FROM captcha WHERE id = ?");
    $sql->bind_param("i", $modify_id);
    $sql->execute();
    $result = $sql->get_result();

    
    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $question = $row['question'];
        $reponse = $row['reponse'];
        

        
    } else {
        echo "Aucun utilisateur trouvé avec cet identifiant.";
    }
} else {
    echo "Identifiant d'utilisateur à modifier non spécifié.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Admin - Modifier le Captcha</title>
    <style>
        .centre {
            text-align: center;
        }
        input {
            padding : 4px;
        }
        </style>
</head>
<body>
    <?php include 'header_admin.php'; ?>
    <div class="centre">
    <h2>Modifier une question / réponse du Captcha</h2>
    <form method="post" action="captcha_traitement.php">
        
        <input type="hidden" name="modify_id" value="<?php echo $modify_id; ?>">
        
        <label for="qestion">Question :</label>
        <input type="text" name="question" value="<?php echo $question; ?>"><br><br>
        <label for="reponse">Réponse :</label>
        <input type="text" name="reponse" value="<?php echo $reponse; ?>"><br><br>
        <input type="submit" name="modifier" value="Modifier">
    </form>
</div>
</body>
</html>
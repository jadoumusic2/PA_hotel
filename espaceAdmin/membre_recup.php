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
    
    
    $sql = $conn->prepare("SELECT nom, prenom, telephone, email FROM utilisateurs WHERE id = ?");
    $sql->bind_param("i", $modify_id);
    $sql->execute();
    $result = $sql->get_result();

    
    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $telephone = $row['telephone'];
        $email = $row['email'];

        
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
    <title>Espace Admin - Modifier un membre</title>
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
    <h2>Modifier un membre</h2>
    <form method="post" action="membre_traitement.php">
        
        <input type="hidden" name="modify_id" value="<?php echo $modify_id; ?>">
        
        <label for="nom">Nom :</label>
        <input type="text" name="nom" value="<?php echo $nom; ?>"><br><br>
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" value="<?php echo $prenom; ?>"><br><br>
        <label for="telephone">Téléphone :</label>
        <input type="text" name="telephone" value="<?php echo $telephone; ?>"><br><br>
        <label for="email">Email :</label>
        <input type="email" name="email" value="<?php echo $email; ?>"><br><br>
        <input type="submit" name="modifier" value="Modifier">
    </form>
</div>
</body>
</html>

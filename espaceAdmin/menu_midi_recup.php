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
    
    
    $sql = $conn->prepare("SELECT date, entre, plat, fromage, dessert, prix_menu FROM menu_midi WHERE id = ?");
    $sql->bind_param("i", $modify_id);
    $sql->execute();
    $result = $sql->get_result();

    
    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $date = $row['date'];
        $entre = $row['entre'];
        $plat = $row['plat'];
        $fromage = $row['fromage'];
        $dessert = $row['dessert'];
        $prix_menu = $row['prix_menu'];

        
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
    <title>Espace Admin - Modifier le menu du midi</title>
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
    <form method="post" action="menu_midi_traitement.php">
        
        <input type="hidden" name="modify_id" value="<?php echo $modify_id; ?>">
        
        <label for="date">Date :</label>
        <input type="date" name="date" value="<?php echo $date; ?>"><br><br>
        <label for="entre">Entrée :</label>
        <input type="text" name="entre" value="<?php echo $entre; ?>"><br><br>
        <label for="plat">Plat :</label>
        <input type="text" name="plat" value="<?php echo $plat; ?>"><br><br>
        <label for="fromage">Fromage :</label>
        <input type="text" name="fromage" value="<?php echo $fromage; ?>"><br><br>
        <label for="dessert">Dessert :</label>
        <input type="text" name="dessert" value="<?php echo $dessert; ?>"><br><br>
        <label for="Prix_menu">Prix :</label>
        <input type="text" name="prix_menu" value="<?php echo $prix_menu; ?>">€<br><br>
        <input type="submit" name="modifier" value="Modifier">
    </form>
</div>
</body>
</html>

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
    
    
    $sql = $conn->prepare("SELECT phone_number, name, days, hours, number, email FROM reservation_resto WHERE id = ?");
    $sql->bind_param("i", $modify_id);
    $sql->execute();
    $result = $sql->get_result();

    
    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $phone_number = $row['phone_number'];
        $email = $row['email'];
        $name = $row['name'];
        $days = $row['days'];
        $hours = $row['hours'];
        $number = $row['number'];
        

        
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
    <title>Espace Admin - Modifier réservation restaurant</title>
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
    <h2>Modifier une réservation du restaurant</h2>
    <form method="post" action="resto_traitement.php">
        
        <input type="hidden" name="modify_id" value="<?php echo $modify_id; ?>">
        
        <label for="phone_number">Numéro de Téléphone :</label>
        <input type="text" name="phone_number" value="<?php echo $phone_number; ?>"><br><br>
        <label for="email">Email :</label>
        <input type="email" name="email" value="<?php echo $email; ?>"><br><br>
        <label for="name">Nom :</label>
        <input type="text" name="name" value="<?php echo $name; ?>"><br><br>
        <label for="days">Jours :</label>
        <input type="date" name="days" value="<?php echo $days; ?>"><br><br>
        <label for="hours">Heures :</label>
        <input type="text" name="hours" value="<?php echo $hours; ?>"><br><br>
        <label for="number">Nombre :</label>
        <input type="text" name="number" value="<?php echo $number; ?>"><br><br>
        <input type="submit" name="modifier" value="Modifier">
    </form>
</div>
</body>
</html>
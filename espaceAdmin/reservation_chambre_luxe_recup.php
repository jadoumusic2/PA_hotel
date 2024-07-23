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
    
    
    $sql = $conn->prepare("SELECT arrival_days, depart_days, number, phone_number, name, email FROM chambre_luxe WHERE id = ?");
    $sql->bind_param("i", $modify_id);
    $sql->execute();
    $result = $sql->get_result();

    
    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $arrival_days = $row['arrival_days'];
        $depart_days = $row['depart_days'];
        $number = $row['number'];
        $phone_number = $row['phone_number'];
        $email = $row['email']; 
        $name = $row['name'];

        
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
    <title>Espace Admin - Modification chambre luxe</title>
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
    <h2>Modifier information chambre luxe :</h2>
    <form method="post" action="reservation_chambre_luxe_traitement.php">
        
        <input type="hidden" name="modify_id" value="<?php echo $modify_id; ?>">
        
        <label for="arrival_days">Date d'arrivée :</label>
        <input type="date" name="arrival_days" value="<?php echo $arrival_days; ?>"><br><br>
        <label for="depart_days">Date de départ :</label>
        <input type="date" name="depart_days" value="<?php echo $depart_days; ?>"><br><br>
        <label for="number">Nombre de personne :</label>
        <input type="number" name="number" value="<?php echo $number; ?>"><br><br>
        <label for="phone_number">Numéro de téléphone :</label>
        <input type="text" name="phone_number" value="<?php echo $phone_number; ?>"><br><br>
        <label for="email">Email :</label>
        <input type="email" name="email" value="<?php echo $email; ?>"><br><br>
        <label for="name">Nom :</label>
        <input type="text" name="name" value="<?php echo $name; ?>"><br><br>
        <input type="submit" name="modifier" value="Modifier">
    </form>
</div>
</body>
</html>

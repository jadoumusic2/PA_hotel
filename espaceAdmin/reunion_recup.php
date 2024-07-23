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
    
    
    $sql = $conn->prepare("SELECT id, nom, numero_telephone, nombre_personne, type_reunion, date, heure, duree_reservation FROM reunion WHERE id = ?");
    $sql->bind_param("i", $modify_id);
    $sql->execute();
    $result = $sql->get_result();

    
    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $nom = $row['nom'];
        $numero_telephone = $row['numero_telephone'];
        $nombre_personne = $row['nombre_personne'];
        $type_reunion = $row['type_reunion'];
        $date = $row['date'];
        $heure = $row['heure'];
        $duree_reservation = $row['duree_reservation'];
        

        
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
    <title>Espace Admin - Modification salle de réunion</title>
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
    <form method="post" action="reunion_traitement.php">
        
        <input type="hidden" name="modify_id" value="<?php echo $modify_id; ?>">
        
        <label for="nom">Nom :</label>
        <input type="text" name="nom" value="<?php echo $nom; ?>"><br><br>
        <label for="numero_telephone">Numéro de téléphone:</label>
        <input type="number" name="numero_telephone" value="<?php echo $numero_telephone; ?>"><br><br>
        <label for="nombre_personne">Nombre de personne :</label>
        <input type="text" name="nombre_personne" value="<?php echo $nombre_personne; ?>"><br><br>
        <label for="type_reunion">Motif :</label>
        <input type="text" name="type_reunion" value="<?php echo $type_reunion; ?>"><br><br>
        <label for="date">Date :</label>
        <input type="date" name="date" value="<?php echo $date; ?>"><br><br>
        <label for="heure">Heure :</label>
        <input type="time" name="heure" value="<?php echo $heure; ?>"><br><br>
        <label for="duree_reservation">Durée de la réservation :</label>
        <input type="number" name="duree_reservation" value="<?php echo $duree_reservation; ?>"><br><br>
        <input type="submit" name="modifier" value="Modifier">
    </form>
</div>
</body>
</html>
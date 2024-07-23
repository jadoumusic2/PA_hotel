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
    
    
    $sql = $conn->prepare("SELECT date_debut, date_fin, prenom, nom, email, nombre, num FROM reservation_offres WHERE id_reservation = ?");
    $sql->bind_param("i", $modify_id);
    $sql->execute();
    $result = $sql->get_result();

    
    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $date_debut = $row['date_debut'];
        $date_fin = $row['date_fin'];
        $prenom = $row['prenom'];
        $nom = $row['nom'];
        $email = $row['email'];
        $nombre = $row['nombre'];
        $num = $row['num'];


        
    } else {
        echo "Aucun évènement trouvé avec cet identifiant.";
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
    <title>Espace Admin - Modifier une réservation d'offre</title>
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
    <h2>Modifier un évènement</h2>
    <form method="post" action="offre_traitement.php">
        
        <input type="hidden" name="modify_id" value="<?php echo $modify_id; ?>">
        
        <label for="date_debut">Date de début :</label>
        <input type="date" name="date_debut" value="<?php echo $date_debut; ?>"><br><br>
        <label for="date_fin">Date de fin :</label>
        <input type="date" name="date_fin" value="<?php echo $date_fin; ?>"><br><br>
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" value="<?php echo $prenom; ?>"><br><br>
        <label for="nom">Nom :</label>
        <input type="text" name="nom" value="<?php echo $nom; ?>"><br><br>
        <label for="email">Email :</label>
        <input type="text" name="email" value="<?php echo $email; ?>"><br><br>
        <label for="nombre">Nombre de personne :</label>
        <input type="number" name="nombre" value="<?php echo $nombre; ?>"><br><br>
        <label for="num">Numéro de téléphone :</label>
        <input type="text" name="num" value="<?php echo $num; ?>"><br><br>
        <input type="submit" name="modifier" value="Modifier">
    </form>
</div>
</body>
</html>
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

include 'header_admin.php';
include '../includes/db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];

    $sql = $conn->prepare("DELETE FROM reservation_offres WHERE id_reservation=?");
    $sql->bind_param("i", $delete_id); 
    if ($sql->execute()) {
        echo "<div class='success'>Réservation supprimée avec succès.</div>";
    } else {
        echo "<div class='error'>Erreur lors de la suppression : " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Admin - Afficher les réservations des offres</title>
    <style>
        .centre {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        form {
            margin : 8px;
        }
        input[type='submit'] {
        padding: 10px 10px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        font-size: 12px;
    }
    .error {
        color: red;
        margin-top: 20px;
        text-align: center;
    }
    .success {
        color: green;
        margin-top: 20px;
        text-align: center;
    }
    </style>
    </head>
<body>

<p>Réservations Offre :</p>
<div class="centre">
  
<?php
$sql_chambre_familial = "SELECT id_reservation, date_debut, date_fin, prenom, nom, email, nombre, num FROM reservation_offres";
$result_chambre_familial = $conn->query($sql_chambre_familial);

if ($result_chambre_familial->num_rows > 0) {
    
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Date d'arrivée</th>
                <th>Date de départ</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Nombre</th>
                <th>Numéro de téléphone</th>
                <th>Action</th>
            </tr>";

    
    while($row = $result_chambre_familial->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id_reservation"]."</td>
                <td>".$row["date_debut"]."</td>
                <td>".$row["date_fin"]."</td>
                <td>".$row["prenom"]."</td>
                <td>".$row["nom"]."</td>
                <td>".$row["email"]."</td>
                <td>".$row["nombre"]."</td>
                <td>".$row["num"]."</td>
                <td>
                <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                    <input type='hidden' name='delete_id' value='".$row["id_reservation"]."'>
                    <input type='submit' name='delete' value='Supprimer'>
                </form>
                    <form method='post' action='offre_recup.php'>
                            <input type='hidden' name='modify_id' value='".$row["id_reservation"]."'>
                            <input type='submit' name='modify' value='Modifier'>
                        </form>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 résultats";
}

$conn->close();
?>
</div>



   
</div>

<br>
<button><a href="logout.php" style="color:red; text-decoration:none;">Déconnexion</a></button>

</body>
</html>
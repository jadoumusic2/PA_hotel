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
    $delete_phone_number = $_POST['delete_phone_number'];

    $sql_delete = "DELETE FROM reservation_resto WHERE phone_number='$delete_phone_number'";
    if ($conn->query($sql_delete) === true) {
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
    <title>Espace Admin - Afficher les réservations du restaurant</title>
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
            margin : 10px;
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
<body>

<p>Réservations :</p>
<div class="centre">
  
<?php
$sql = "SELECT id, phone_number, name, days, hours, number, email FROM reservation_resto";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Numéro de téléphone</th>
                <th>Email</th>
                <th>Nom</th>
                <th>Jours</th>
                <th>Heures</th>
                <th>Nombre</th>
                <th>Action</th>
            </tr>";

    
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row["phone_number"]."</td>
                <td>".$row["email"]."</td>
                <td>".$row["name"]."</td>
                <td>".$row["days"]."</td>
                <td>".$row["hours"]."</td>
                <td>".$row["number"]."</td>
                <td>
                    <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                        <input type='hidden' name='delete_phone_number' value='".$row["phone_number"]."'>
                        <input type='submit' name='delete' value='Supprimer'>
                    </form>
                    <form method='post' action='resto_recup.php'>
                            <input type='hidden' name='modify_id' value='".$row["id"]."'>
                            <input type='submit' name='modify' value='Modifier'>
                        </form>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<div class='error'>0 résultats</div>";
}
$conn->close();
?>

   
</div>

<br>
<button><a href="logout.php" style="color:red; text-decoration:none;">Déconnexion</a></button>

</body>
</html>

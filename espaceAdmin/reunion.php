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

    $sql = $conn->prepare("DELETE FROM reunion WHERE id=?");
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
    <title>Espace Admin - Réunion</title>
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
$sql = "SELECT id, nom, numero_telephone, nombre_personne, type_reunion, date, heure, duree_reservation FROM reunion";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Numéro de téléphone</th>
                <th>Nombre de personne</th>
                <th>Motif</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Durée de la réservation</th>
                <th>Action</th>
            </tr>";

    
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row["nom"]."</td>
                <td>".$row["numero_telephone"]."</td>
                <td>".$row["nombre_personne"]."</td>
                <td>".$row["type_reunion"]."</td>
                <td>".$row["date"]."</td>
                <td>".$row["heure"]."</td>
                <td>".$row["duree_reservation"]." heure(s)</td>
                <td>
                    <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                        <input type='hidden' name='delete_id' value='".$row["id"]."'>
                        <input type='submit' name='delete' value='Supprimer'>
                    </form>
                    <form method='post' action='reunion_recup.php'>
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

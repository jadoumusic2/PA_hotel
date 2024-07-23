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

    $sql_delete = "DELETE FROM contact WHERE id='$delete_id'";
    if ($conn->query($sql_delete) === true) {
        echo "<div class='success'>Message supprimé avec succès.</div>";
    } else {
        echo "<div class='error'>Erreur lors de la suppression : " . $conn->error. "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Admin - Afficher les messages</title>
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
<body>

<p>Messages des utilisateurs :</p>
<div class="centre">
  
<?php
$sql = "SELECT id, email, nom, numero_telephone, message, date, priorite 
FROM contact 
ORDER BY date, 
         CASE priorite 
             WHEN 'Haute' THEN 1 
             WHEN 'Moyenne' THEN 2 
             WHEN 'Basse' THEN 3 
         END";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Nom</th>
                <th>Numéro de téléphone</th>
                <th>Problèmes</th>
                <th>Date</th>
                <th>Priorité</th>
                <th>Action</th>
            </tr>";

    
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["email"]."</td>
                <td>".$row["nom"]."</td>
                <td>".$row["numero_telephone"]."</td>
                <td>".$row["message"]."</td>
                <td>".$row["date"]."</td>
                <td>".$row["priorite"]."</td>
                <td>
                    <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                        <input type='hidden' name='delete_id' value='".$row["id"]."'>
                        <input type='submit' name='delete' value='Supprimer'>
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

<br>
<button><a href="logout.php" style="color:red; text-decoration:none;">Déconnexion</a></button>

</body>
</html>
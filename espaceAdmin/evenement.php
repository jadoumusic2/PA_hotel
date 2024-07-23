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

    $sql = $conn->prepare("DELETE FROM evenement WHERE id=?");
    $sql->bind_param("i", $delete_id); 
    if ($sql->execute()) {
        echo "<div class='success'>Réservation supprimée avec succès.</div>";
    } else {
        echo "<div class='error'>Erreur lors de la suppression : " . $conn->error . "</div>";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['titre'], $_POST['image'], $_POST['description'])) {
        
        $titre = $_POST['titre'];
        $image = $_POST['image'];
        $description = $_POST['description'];

        $sql = "INSERT INTO evenement (titre, image, description) VALUES ('$titre', '$image', '$description')";
        if ($conn->query($sql) === true) {
            echo "<div class='success'>Evènement ajouté avec succès.</div>";
        } else {
            echo "<div class='error'>Erreur : ". $sql. "<br>". $conn->error. "</div>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evènements :</title>
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

<div class="centre">
    <h2>Espace Admin - Evènement</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="titre">Titre :</label><br>
        <input type="titre" id="titre" name="titre" required><br><br>
        <label for="image">Image :</label><br>
        <input type="text" id="image" name="image" required><br><br>
        <label for="description">Description :</label><br>
        <input type="text" id="description" name="description" required><br><br>
        <input type="submit" value="Ajouter">
    </form>

</div>

<p>Evènements :</p>
<div class="centre">
  
<?php
$sql = "SELECT id, titre, image, description FROM evenement";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Image</th>
                <th>Description</th>
                <th>Action</th>
            </tr>";

    
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row["titre"]."</td>
                <td>".$row["image"]."</td>
                <td>".$row["description"]."</td>
                <td>
                    <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                        <input type='hidden' name='delete_id' value='".$row["id"]."'>
                        <input type='submit' name='delete' value='Supprimer'>
                    </form>
                    <form method='post' action='evenement_recup.php'>
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

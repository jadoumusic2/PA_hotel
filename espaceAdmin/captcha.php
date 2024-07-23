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

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'header_admin.php';
include '../includes/db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    

    
    $question = $_POST['question'];
    $reponse = $_POST['reponse'];

    
    $sql = "INSERT INTO captcha (question, reponse) VALUES ('$question', '$reponse')";
    if ($conn->query($sql) === true) {
        echo "<div class='success'>Question et réponse ajoutées avec succès.</div>";
    } else {
        echo "<div class='error'>Erreur : " . $sql . "<br>" . $conn->error . "</div>";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];

    
    $sql = $conn->prepare("DELETE FROM captcha WHERE id=?");
    $sql->bind_param("i", $delete_id);
    if ($sql->execute()) {
        echo "<div class='success'>Réservation supprimée avec succès.</div>";
    } else {
        echo "<div class='error'>Erreur lors de la suppression : " . $conn->error . "</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Espace Admin - Gestion CAPTCHA</title>
    <style>
        .centre {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
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
</head>

<body>

    <div class="centre">
        <h2>Captcha</h2>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="question">Question :</label><br>
            <input type="text" id="question" name="question" required><br><br>
            <label for="reponse">Réponse :</label><br>
            <input type="text" id="reponse" name="reponse" required><br><br>
            <input type="submit" name="add" value="Ajouter">
        </form>

        <h3>Questions et réponses existantes</h3>

        <?php
        
        include '../includes/db.php';

        $sql = "SELECT id, question, reponse FROM captcha";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            
            echo "<table>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Réponse</th>
                <th>Action</th>
            </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["question"] . "</td>
                <td>" . $row["reponse"] . "</td>
                <td>
                <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
                <input type='hidden' name='delete_id' value='" . $row["id"] . "'>
                <input type='submit' name='delete' value='Supprimer'>
                </form>
                <form method='post' action='captcha_recup.php'>
                            <input type='hidden' name='modify_id' value='".$row["id"]."'>
                            <input type='submit' name='modify' value='Modifier'>
                        </form>
                </td>
              </tr>";
            }

            echo "</table>";
        } else {
            echo "No data found";
        }

        $conn->close();
        ?>

    </div>
    <br>
    <button><a href="logout.php" style="color:red; text-decoration:none;">Déconnexion</a></button> <!-- Lien pour se déconnecter -->
</body>

</html>

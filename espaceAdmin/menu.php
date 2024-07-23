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



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_midi'])) {
    $delete_id_midi = $_POST['delete_id_midi'];

    $sql_delete_midi = "DELETE FROM menu_midi WHERE id='$delete_id_midi'";
    if ($conn->query($sql_delete_midi) === true) {
        echo "<div class='success'>Réservation du menu du midi supprimée avec succès.</div>";
    } else {
        echo "<div class='error'>Erreur lors de la suppression : " . $conn->error. "</div>";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_soir'])) {
    $delete_id_soir = $_POST['delete_id_soir'];

    $sql_delete_soir = "DELETE FROM menu_soir WHERE id='$delete_id_soir'";
    if ($conn->query($sql_delete_soir) === true) {
        echo "<div class='success'>Réservation du menu du soir supprimée avec succès.</div>";
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
    <title>Espace Admin - Menu</title>
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
</head>
<body>

<p>Menu du Midi :</p>
<div class="centre">
    
    <?php
    $sql_midi = "SELECT id, date, entre, plat, fromage, dessert, prix_menu FROM menu_midi";
    $result_midi = $conn->query($sql_midi);

    if ($result_midi->num_rows > 0) {
        
        echo "<table>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Entrée</th>
                <th>Plat</th>
                <th>Fromage</th>
                <th>Dessert</th>
                <th>Prix</th>
                <th>Action</th>
            </tr>";

        
        while($row = $result_midi->fetch_assoc()) {
            echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["date"]."</td>
                <td>".$row["entre"]."</td>
                <td>".$row["plat"]."</td>
                <td>".$row["fromage"]."</td>
                <td>".$row["dessert"]."</td>
                <td>".$row["prix_menu"]."€</td>
                <td>
                    <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                        <input type='hidden' name='delete_id_midi' value='".$row["id"]."'>
                        <input type='submit' name='delete_midi' value='Supprimer'>
                    </form>
                    <form method='post' action='menu_midi_recup.php'>
                            <input type='hidden' name='modify_id' value='".$row["id"]."'>
                            <input type='submit' name='modify' value='Modifier'>
                        </form>
                </td>
              </tr>";
        }
        echo "</table>";
    } else {
        echo "0 résultats";
    }
    ?>
</div>

<p>Menu Soir :</p>
<div class="centre">
    <?php
    $sql_soir = "SELECT id, date, entre, plat, fromage, dessert, prix_menu FROM menu_soir";
    $result_soir = $conn->query($sql_soir);

    if ($result_soir->num_rows > 0) {
        
        echo "<table>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Entrée</th>
                <th>Plat</th>
                <th>Fromage</th>
                <th>Dessert</th>
                <th>Prix</th>
                <th>Action</th>
            </tr>";

        
        while($row = $result_soir->fetch_assoc()) {
            echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["date"]."</td>
                <td>".$row["entre"]."</td>
                <td>".$row["plat"]."</td>
                <td>".$row["fromage"]."</td>
                <td>".$row["dessert"]."</td>
                <td>".$row["prix_menu"]."€</td>
                <td>
                    <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                        <input type='hidden' name='delete_id_soir' value='".$row["id"]."'>
                        <input type='submit' name='delete_soir' value='Supprimer'>
                    </form>
                    <form method='post' action='menu_soir_recup.php'>
                            <input type='hidden' name='modify_id' value='".$row["id"]."'>
                            <input type='submit' name='modify' value='Modifier'>
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

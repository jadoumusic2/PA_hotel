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


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_chambre_familial'])) {
    $delete_id_chambre_familial = $_POST['delete_id_chambre_familial'];

    $sql_delete_chambre_familial = "DELETE FROM chambre_familial WHERE id='$delete_id_chambre_familial'";
    if ($conn->query($sql_delete_chambre_familial) === true) {
        echo "<div class='success'>Réservation supprimée avec succès.</div>";
    } else {
        echo "<div class='error'>Erreur lors de la suppression : " . $conn->error. "</div>";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_chambre_romance'])) {
    $delete_id_chambre_romance = $_POST['delete_id_chambre_romance'];

    $sql_delete_chambre_romance = "DELETE FROM chambre_romance WHERE id='$delete_id_chambre_romance'";
    if ($conn->query($sql_delete_chambre_romance) === true) {
        echo "<div class='success'>Réservation supprimée avec succès.</div>";
    } else {
        echo "<div class='error'>Erreur lors de la suppression : " . $conn->error. "</div>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_chambre_luxe'])) {
    $delete_id_chambre_luxe = $_POST['delete_id_chambre_luxe'];

    $sql_delete_chambre_luxe = "DELETE FROM chambre_luxe WHERE id='$delete_id_chambre_luxe'";
    if ($conn->query($sql_delete_chambre_luxe) === true) {
        echo "<div class='success'>Réservation supprimée avec succès.</div>";
    } else {
        echo "<div class='error'>Erreur lors de la suppression : " . $conn->error. "</div>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_suite_a'])) {
    $delete_id_suite_a = $_POST['delete_id_suite_a'];

    $sql_delete_suite_a = "DELETE FROM suites_a WHERE id='$delete_id_suite_a'";
    if ($conn->query($sql_delete_suite_a) === true) {
        echo "<div class='success'>Réservation supprimée avec succès.</div>";
    } else {
        echo "<div class='error'>Erreur lors de la suppression : " . $conn->error. "</div>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_suite_b'])) {
    $delete_id_suite_b = $_POST['delete_id_suite_b'];

    $sql_delete_suite_b = "DELETE FROM suites_b WHERE id='$delete_id_suite_b'";
    if ($conn->query($sql_delete_suite_b) === true) {
        echo "<div class='success'>Réservation supprimée avec succès.</div>";
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
    <title>Espace Admin - Afficher les réservations des chambres</title>
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

<p>Réservations Chambres Familial :</p>
<div class="centre">
  
<?php
$sql_chambre_familial = "SELECT id, arrival_days, depart_days, number, phone_number, name, email FROM chambre_familial ORDER BY arrival_days";
$result_chambre_familial = $conn->query($sql_chambre_familial);

if ($result_chambre_familial->num_rows > 0) {
    
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Date d'arrivée</th>
                <th>Date de départ</th>
                <th>Nombre de personne</th>
                <th>Numéro de téléphone</th>
                <th>Email</th>
                <th>Nom</th>
                <th>Action</th>
            </tr>";

    
    while($row = $result_chambre_familial->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["arrival_days"]."</td>
                <td>".$row["depart_days"]."</td>
                <td>".$row["number"]."</td>
                <td>".$row["phone_number"]."</td>
                <td>".$row["email"]."</td>
                <td>".$row["name"]."</td>
                <td>
                    <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                        <input type='hidden' name='delete_id_chambre_familial' value='".$row["id"]."'>
                        <input type='submit' name='delete_chambre_familial' value='Supprimer'>
                    </form>
                    <form method='post' action='reservation_chambre_familial_recup.php'>
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

<p>Réservations Chambres Romance :</p>
<div class="centre">
  
<?php
$sql_chambre_romance = "SELECT id, arrival_days, depart_days, number, phone_number, name, email FROM chambre_romance ORDER BY arrival_days";
$result_chambre_romance = $conn->query($sql_chambre_romance);

if ($result_chambre_romance->num_rows > 0) {
    
    echo "<table>
            <tr>
            <th>ID</th>
            <th>Date d'arrivée</th>
            <th>Date de départ</th>
            <th>Nombre de personne</th>
            <th>Numéro de téléphone</th>
            <th>Email</th>
            <th>Nom</th>
            <th>Action</th>
        </tr>";


while($row = $result_chambre_romance->fetch_assoc()) {
    echo "<tr>
            <td>".$row["id"]."</td>
            <td>".$row["arrival_days"]."</td>
            <td>".$row["depart_days"]."</td>
            <td>".$row["number"]."</td>
            <td>".$row["phone_number"]."</td>
            <td>".$row["email"]."</td>
            <td>".$row["name"]."</td>
            <td>
                <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                    <input type='hidden' name='delete_id_chambre_romance' value='".$row["id"]."'>
                    <input type='submit' name='delete_chambre_romance' value='Supprimer'>
                </form>
                <form method='post' action='reservation_chambre_romance_recup.php'>
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

<p>Réservations Chambres Luxe :</p>
<div class="centre">
  
<?php
$sql_chambre_luxe = "SELECT id, arrival_days, depart_days, number, phone_number, name, email FROM chambre_luxe ORDER BY arrival_days";
$result_chambre_luxe = $conn->query($sql_chambre_luxe);

if ($result_chambre_luxe->num_rows > 0) {
    
    echo "<table>
            <tr>
            <th>ID</th>
                <th>Date d'arrivée</th>
                <th>Date de départ</th>
                <th>Nombre de personne</th>
                <th>Numéro de téléphone</th>
                <th>Email</th>
                <th>Nom</th>
                <th>Action</th>
            </tr>";

    
    while($row = $result_chambre_luxe->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["arrival_days"]."</td>
                <td>".$row["depart_days"]."</td>
                <td>".$row["number"]."</td>
                <td>".$row["phone_number"]."</td>
                <td>".$row["email"]."</td>
                <td>".$row["name"]."</td>
                <td>
                    <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                        <input type='hidden' name='delete_id_chambre_luxe' value='".$row["id"]."'>
                        <input type='submit' name='delete_chambre_luxe' value='Supprimer'>
                    </form>
                    <form method='post' action='reservation_chambre_luxe_recup.php'>
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

<p>Réservations Suites A :</p>
<div class="centre">
  
<?php
$sql_suite_a = "SELECT id, arrival_days, depart_days, number, phone_number, name, email FROM suites_a ORDER BY arrival_days";
$result_suite_a = $conn->query($sql_suite_a);

if ($result_suite_a->num_rows > 0) {
    
    echo "<table>
            <tr>
            <th>ID</th>
            <th>Date d'arrivée</th>
            <th>Date de départ</th>
            <th>Nombre de personne</th>
            <th>Numéro de téléphone</th>
            <th>Email</th>
            <th>Nom</th>
            <th>Action</th>
        </tr>";


while($row = $result_suite_a->fetch_assoc()) {
    echo "<tr>
            <td>".$row["id"]."</td>
            <td>".$row["arrival_days"]."</td>
            <td>".$row["depart_days"]."</td>
            <td>".$row["number"]."</td>
            <td>".$row["phone_number"]."</td>
            <td>".$row["email"]."</td>
            <td>".$row["name"]."</td>
            <td>
                <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                    <input type='hidden' name='delete_id_suite_a' value='".$row["id"]."'>
                    <input type='submit' name='delete_suite_a' value='Supprimer'>
                </form>
                <form method='post' action='reservation_suite_a_recup.php'>
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

<p>Réservations Suites B :</p>
<div class="centre">
  
<?php
$sql_suite_b = "SELECT id, arrival_days, depart_days, number, phone_number, name, email FROM suites_b ORDER BY arrival_days";
$result_suite_b = $conn->query($sql_suite_b);

if ($result_suite_b->num_rows > 0) {
    
    echo "<table>
            <tr>
            <th>ID</th>
                <th>Date d'arrivée</th>
                <th>Date de départ</th>
                <th>Nombre de personne</th>
                <th>Numéro de téléphone</th>
                <th>Email</th>
                <th>Nom</th>
                <th>Action</th>
            </tr>";

    
    while($row = $result_suite_b->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["arrival_days"]."</td>
                <td>".$row["depart_days"]."</td>
                <td>".$row["number"]."</td>
                <td>".$row["phone_number"]."</td>
                <td>".$row["email"]."</td>
                <td>".$row["name"]."</td>
                <td>
                    <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                        <input type='hidden' name='delete_id_suite_b' value='".$row["id"]."'>
                        <input type='submit' name='delete_suite_b' value='Supprimer'>
                    </form>
                    <form method='post' action='reservation_suite_b_recup.php'>
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

$conn->close();
?>
</div>



   
</div>

<br>
<button><a href="logout.php" style="color:red; text-decoration:none;">Déconnexion</a></button>

</body>
</html>
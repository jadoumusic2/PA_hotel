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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['date'], $_POST['entre'], $_POST['plat'], $_POST['fromage'], $_POST['dessert'], $_POST['prix_menu'])) {
        
        $date = $_POST['date'];
        $entre = $_POST['entre'];
        $plat = $_POST['plat'];
        $fromage = $_POST['fromage'];
        $dessert = $_POST['dessert'];
        $prix_menu = $_POST['prix_menu'];

        $sql = "INSERT INTO menu_midi (date, entre, plat, fromage, dessert, prix_menu) VALUES ('$date', '$entre', '$plat', '$fromage', '$dessert', '$prix_menu')";
        if ($conn->query($sql) === true) {
            echo "<div class='success'>Menu midi ajouté avec succès.</div>";
        } else {
            echo "<div class='error'>Erreur : ". $sql. "<br>". $conn->error. "</div>";
        }
    } elseif (isset($_POST['date_soir'], $_POST['entre_soir'], $_POST['plat_soir'], $_POST['fromage_soir'], $_POST['dessert_soir'], $_POST['prix_menu_soir'])) {
        
        $date_soir = $_POST['date_soir'];
        $entre_soir = $_POST['entre_soir'];
        $plat_soir = $_POST['plat_soir'];
        $fromage_soir = $_POST['fromage_soir'];
        $dessert_soir = $_POST['dessert_soir'];
        $prix_menu_soir = $_POST['prix_menu_soir'];
    
        $sql = "INSERT INTO menu_soir (date, entre, plat, fromage, dessert, prix_menu) VALUES ('$date_soir', '$entre_soir', '$plat_soir', '$fromage_soir', '$dessert_soir', '$prix_menu_soir')";
        if ($conn->query($sql) === true) {
            echo "<div class='success'>Menu soir ajouté avec succès.</div>";
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
    <title>Espace Admin - Gestion Menu</title>
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
    <h2>Menu Midi</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="date">Date :</label><br>
        <input type="date" id="date" name="date" required><br><br>
        <label for="entre">Entrée :</label><br>
        <input type="text" id="entre" name="entre" required><br><br>
        <label for="plat">Plat :</label><br>
        <input type="text" id="plat" name="plat" required><br><br>
        <label for="fromage">Fromage :</label><br>
        <input type="text" id="fromage" name="fromage" required><br><br>
        <label for="dessert">Dessert :</label><br>
        <input type="text" id="dessert" name="dessert" required><br><br>
        <label for="prix_menu">Prix du menu :</label><br>
        <input type="number" id="prix_menu" name="prix_menu" required><br><br>
        <input type="submit" value="Ajouter">
    </form>

</div>

<div class="centre">
    <h2>Menu Soir</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="date_soir">Date :</label><br>
        <input type="date" id="date_soir" name="date_soir" required><br><br>
        <label for="entre_soir">Entrée :</label><br>
        <input type="text" id="entre_soir" name="entre_soir" required><br><br>
        <label for="plat_soir">Plat :</label><br>
        <input type="text" id="plat_soir" name="plat_soir" required><br><br>
        <label for="fromage_soir">Fromage :</label><br>
        <input type="text" id="fromage_soir" name="fromage_soir" required><br><br>
        <label for="dessert_soir">Dessert :</label><br>
        <input type="text" id="dessert_soir" name="dessert_soir" required><br><br>
        <label for="prix_menu_soir">Prix du menu :</label><br>
        <input type="number" id="prix_menu_soir" name="prix_menu_soir" required><br><br>
        <input type="submit" value="Ajouter">
    </form>

</div>

<?php include 'footer.php';?>

</body>
</html>

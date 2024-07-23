<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PALASO</title>
    <link rel="stylesheet" href="reunion.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <?php include 'includes/header.php'; ?>

      <main>

      <div class="container">
            <div class="row justify-content-center mt-5">
                 <div class="col-md-3">
                     <form class="d-flex" role="search" action="index.php" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search" name="search_keyword" style="width: 200px; margin-bottom: 30px;">
                        <button class="btn btn-dark" type="submit" style="margin-bottom: 30px;">Rechercher</button>
                    </form>
                 </div>
            </div>
        </div>

        <?php
include 'includes/db.php';


$sql_select_reservations = "SELECT * FROM reunion order by date asc";
$result = $conn->query($sql_select_reservations);

if ($result->num_rows > 0) {
    echo "<section class='container'>";
    echo "<h2>Réservations existantes</h2>";
    echo "<table class='table'>";
    echo "<thead>";
    echo "<tr><th>Nom</th><th>Numéro de téléphone</th><th>Nombre de personnes</th><th>Motif</th><th>Date</th><th>Heure</th><th>Durée</th></tr>";
    echo "</thead>";
    echo "<tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nom"] . "</td>";
        echo "<td>" . $row["numero_telephone"] . "</td>";
        echo "<td>" . $row["nombre_personne"] . "</td>";
        echo "<td>" . $row["type_reunion"] . "</td>";
        echo "<td>" . $row["date"] . "</td>";
        echo "<td>" . $row["heure"] . "</td>";
        echo "<td>" . $row["duree_reservation"] . " heure(s)</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</section>";
} else {
    echo "<section class='container'>";
    echo "<p>Aucune réservation existante.</p>";
    echo "</section>";
}


$conn->close();
?>

      <section class="container">
            <h2>Réunions</h2>
            <p>Organisez vos réunions dans nos salles équipées de haute technologie.</p>

            <?php
include 'includes/db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nom = $_POST['nom'];
    $nombre_personne = $_POST['nombre_personne'];
    $type_reunion = $_POST['type_reunion'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $numero_telephone = $_POST['numero_telephone'];
    $duree_reservation = $_POST['duree_reservation'];

    
    $date_actuelle = date("Y-m-d");
    if ($date < $date_actuelle) {
        echo "<div class='error'>La date de réservation ne peut pas être antérieure à la date actuelle.</div>";
    } else {
       
        $sql_check_availability = "SELECT COUNT(*) as count FROM reunion WHERE date = '$date' AND heure = '$heure'";
        $result = $conn->query($sql_check_availability);
        $row = $result->fetch_assoc();
        $count = $row['count'];
        if ($count > 0) {
                echo "<div class='error'>La salle n'est pas disponible à cette heure.</div>";
        } else {
            
            if ($duree_reservation < 1 || $duree_reservation > 3) {
                echo "<div class='error'>La durée de réservation doit être comprise entre 1 et 3 heures.</div>";
        } else {
            
            if ($nombre_personne > 20) {
                echo "<div class='error'>Le nombre de personnes ne peut pas dépasser 20.</div>";
            } else {
                
                $sql_insert_reservation = "INSERT INTO reunion (nom, numero_telephone, nombre_personne, type_reunion, date, heure, duree_reservation) VALUES ('$nom', '$numero_telephone', '$nombre_personne', '$type_reunion', '$date', '$heure', '$duree_reservation')";
                if ($conn->query($sql_insert_reservation) === TRUE) {
                    echo "<div class='success'>Réservation enregistrée avec succès.</div>";
                } else {
                    echo "<div class='error'>Erreur: " . $sql_insert_reservation . "<br>" . $conn->error . "</div>";
                }
            }
        }
    }
}
    
    $conn->close();
}
?>


<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form method="post">
                <label for="nom">Nom :</label><br>
                <input type="text" class="form-control" name="nom" placeholder="Nom" required><br>
                
                <label for="numero_telephone">Numéro de téléphone :</label><br>
                <input type="text" class="form-control" name="numero_telephone" placeholder="00/00/00/00/00" required><br>
                
                <label for="nombre_personne">Nombre de personnes : (25 max)</label><br>
                <input type="number" class="form-control" name="nombre_personne" placeholder="0" required><br>
                
                <label for="type_reunion">Motif :</label><br>
                <input type="text" class="form-control" name="type_reunion" placeholder="Motif" required><br>
                
                <label for="date">Date :</label><br>
                <input type="date" class="form-control" name="date" required><br>
                
                <label for="heure">Heure :</label><br>
                <input type="time" class="form-control" name="heure" required><br>

                <label for="duree_reservation">Temps de la réservation : (1h minimum et 3h maximum)</label><br>
                <input type="number" class="form-control" name="duree_reservation" placeholder="0" required><br><br>
                
                <input type="submit" class="btn btn-dark" value="Réserver"><br>
            </form>
        </div>
        <div class="col-md-6">
            <img src="image/salle-de-reunion.jpg" class="img-fluid" alt="fond">
        </div>
    </div>
</div>

</section>

      <?php include 'includes/logo.php'; ?>
      
</main>

      <?php include 'includes/footer.php'; ?>
      
      </body>
      </html>
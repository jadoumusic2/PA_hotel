<?php

include 'includes/db.php';
session_start(); 

if (!isset($_SESSION['email'])) {
    header("Location: connexion.php");
    exit();
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $_POST['name'];
    $arrival_days = $_POST['arrival_days'];
    $depart_days = $_POST['depart_days'];
    $number = $_POST['number'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];

    
    if (strtotime($arrival_days) < strtotime(date('Y-m-d'))) {
        echo "<div class='error'>Vous ne pouvez pas réserver une date antérieure à aujourd'hui.</div>";
    } elseif ($arrival_days >= $depart_days) {
        echo "<div class='error'>La date de départ doit être postérieure à la date d'arrivée.</div>";
    } elseif ($number > 2) {
        echo "<div class='error'>Le nombre de personnes ne peut pas dépasser 2.</div>";
    } else {
        
        $query = "SELECT * FROM chambre_romance WHERE (arrival_days <= '$arrival_days' AND depart_days >= '$depart_days') OR (arrival_days <= '$arrival_days' AND depart_days >= '$arrival_days') OR (arrival_days >= '$arrival_days' AND depart_days <= '$depart_days')";
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            echo "<div class='error'>La chambre est déjà réservée pour ces dates.</div>";

          
            $query = "SELECT MIN(depart_days) AS next_available_date FROM chambre_romance WHERE depart_days > CURDATE()";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $next_available_date = $row['next_available_date'];

            if ($next_available_date) {
                echo "<div class='info'>La prochaine date disponible pour la réservation est le $next_available_date.</div>";
            }
        } else {
          
            $sql = "INSERT INTO chambre_romance (phone_number, name, arrival_days, depart_days, number, email) VALUES ('$phone_number', '$name', '$arrival_days', '$depart_days', '$number', '$email')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='success'>Réservation enregistrée avec succès.</div>";
                header("Location: https://buy.stripe.com/test_fZe2aD3zF0zl3zGdQS");
                exit();
            } else {
                echo "<div class='error'>Erreur: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }
    }
}


$conn->close();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PALASO</title>
  <link rel="stylesheet" href="reservation.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
    
    <?php include 'includes/header.php'; ?>

    <main>

    <div class="fonds">
      <img src="image/chambres_romance.jpg" alt="fonds-header">

    </div>

    <section class="book">
    <div class="container flex">
        <div class="input grid">
            <div class="box">
                <form method="post">
                    <label>Date du début de la réservation : </label>
                    <input type="date" name="arrival_days" placeholder="Date Début" required>
            </div>
            <div class="box">
                    <label>Date de la fin de la réservation : </label>
                    <input type="date" name="depart_days" placeholder="Date Fin" required>
            </div>
            <div class="box">
                <label>Nombres de personnes : </label><br>
                <input type="number" name="number" placeholder="0" required>
            </div>
            <div class="box">
                <label>Numéro de téléphone : </label>
                <input type="text" name="phone_number" placeholder="00/00/00/00/00" required>
            </div>
            <div class="box">
                <label>Nom de la réservation :</label>
                <input type="text" name="name" placeholder="Nom" required>
            </div>
            <div class="box">
                <label>Email :</label>
                <input type="text" name="email" placeholder="Email" required>
            </div>
            
            <div class="search">
            <button type="submit" class="btn-reserve">Réservez</button>
            </form>
            </div>
        </div>
    </div>
</section>

<div class="description">

<section class="container">
    <h1>Chambre Romance</h1>
            <p>Voici la chambre romance de l'hôtel Palaso.</p>
            <h2>650€</h2>
            <div class="container mt-5">
            <div class="row">
    <div class="col-md-6">
        <img src="image/chambre_romance_1.jpg" class="img-fluid" alt="fond">
    </div>
    <div class="col-md-6 d-flex align-items-center">
        <div class="long-sejour text-center">
        <p>
        Découvrez l'intimité envoûtante et le charme romantique d'une chambre conçue pour les amoureux dans notre hôtel exclusif.
    À travers la porte, un monde de douceur et de passion s'ouvre à vous, avec des touches délicates et une ambiance chaleureuse. </p>
        </div>
    </div>
</div>
</div>

<div class="container mt-5">
            <div class="row">

    <div class="col-md-6 d-flex align-items-center">
        <div class="long-sejour text-center">
        <p> 
        Le lit king-size, drapé de satin, invite à des moments de tendresse et de complicité, tandis que les bougies parfumées créent une lueur douce et envoûtante. 
    Les pétales de roses jonchent le sol, ajoutant une touche de romance à chaque recoin de l'espace.  </p>
        </div>
    </div>
    <div class="col-md-6">
        <img src="image/chambre_romance_2.jpg" class="img-fluid" alt="fond">
    </div>
</div>
</div>

<div class="container mt-5">
            <div class="row">
    <div class="col-md-6">
        <img src="image/chambre_romance_3.jpg" class="img-fluid" alt="fond">
    </div>
    <div class="col-md-6 d-flex align-items-center">
        <div class="long-sejour text-center">
        <p> 
        Les fenêtres offrent des vues spectaculaires sur des paysages à couper le souffle, offrant le cadre idéal pour des instants inoubliables à deux. 
    Dans cette chambre, le temps semble suspendu, laissant place à l'amour et à la passion qui embrasent les cœurs</p>
        </div>
    </div>
</div>
</div>

<div class="container mt-5">
            <div class="row">
    <div class="col-md-6 d-flex align-items-center">
        <div class="long-sejour text-center">
        <p>
        Laissez-vous emporter par une expérience sensorielle où chaque détail est soigneusement orchestré pour raviver la flamme de la romance et créer des souvenirs intemporels à deux. 
        Entrez dans un havre de paix où le temps semble s'arrêter, offrant un refuge idyllique pour explorer les profondeurs de l'amour et de la connexion.</p>
        </div>
    </div>
    <div class="col-md-6">
        <img src="image/chambre_romance_4.jpg" class="img-fluid" alt="fond">
    </div>
</div>
</div>
        </section>

    <?php include 'includes/logo.php'; ?>

</main>

    <?php include 'includes/footer.php'; ?>
    
</body>

</html>
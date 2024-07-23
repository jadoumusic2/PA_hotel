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
    } elseif ($number > 4) {
        echo "<div class='error'>Le nombre de personnes ne peut pas dépasser 4.</div>";
    } else {
        
        $query = "SELECT * FROM suites_b WHERE (arrival_days <= '$arrival_days' AND depart_days >= '$depart_days') OR (arrival_days <= '$arrival_days' AND depart_days >= '$arrival_days') OR (arrival_days >= '$arrival_days' AND depart_days <= '$depart_days')";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<div class='error'>La chambre est déjà réservée pour ces dates.</div>";
                
                $query = "SELECT MIN(depart_days) AS next_available_date FROM suites_b WHERE depart_days > CURDATE()";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
                $next_available_date = $row['next_available_date'];

                if ($next_available_date) {
                    echo "<div class='success'>La prochaine date disponible pour la réservation est le $next_available_date.</div>";
                }
            
        } else {
           
            $sql = "INSERT INTO suites_b (phone_number, name, arrival_days, depart_days, number, email) VALUES ('$phone_number', '$name', '$arrival_days', '$depart_days', '$number', '$email')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='success'>Réservation enregistrée avec succès.</div>";
                header("Location: https://buy.stripe.com/test_00gbLd1rxbdZb28dQU");
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
      <img src="image/suites_luxe.jpg" alt="fonds-header">

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

<section class="container">
    <h1>Suite B</h1>
            <p>Voici la suite B de l'hôtel Palaso.</p>
            <h2>1200€</h2>
            <div class="container mt-5">
            <div class="row">
    <div class="col-md-6">
        <img src="image/suite_b_1.jpg" class="img-fluid" alt="fond">
    </div>
    <div class="col-md-6 d-flex align-items-center">
        <div class="long-sejour text-center">
        <p>
        Bienvenue dans l'ultime expérience de luxe, où chaque instant est une célébration de l'opulence et du raffinement. 
    Notre suite de luxe, un véritable joyau au sein de notre hôtel prestigieux, vous transporte dans un monde de splendeur et d'élégance.  </p>
        </div>
    </div>
</div>
</div>

<div class="container mt-5">
            <div class="row">

    <div class="col-md-6 d-flex align-items-center">
        <div class="long-sejour text-center">
        <p> 
        Dès que vous franchissez la porte, vous êtes accueilli par un espace somptueux, où les lignes épurées du design contemporain se marient harmonieusement avec des touches de luxe intemporel. 
    Les espaces de vie spacieux sont parés de meubles exquis et de matériaux de la plus haute qualité, créant une ambiance de grandeur et de sophistication.   </p>
        </div>
    </div>
    <div class="col-md-6">
        <img src="image/suite_b_2.jpg" class="img-fluid" alt="fond">
    </div>
</div>
</div>

<div class="container mt-5">
            <div class="row">
    <div class="col-md-6">
        <img src="image/suite_b_3.jpg" class="img-fluid" alt="fond">
    </div>
    <div class="col-md-6 d-flex align-items-center">
        <div class="long-sejour text-center">
        <p> 
        Les vues panoramiques depuis les fenêtres offrent un spectacle à couper le souffle, tandis que les équipements de classe mondiale garantissent un confort absolu. 
    Dans cette suite de luxe, chaque moment est une expérience de pure indulgence et d'exclusivité, où vos rêves les plus extravagants deviennent réalité.</p>
        </div>
    </div>
</div>
</div>

<div class="container mt-5">
            <div class="row">
    <div class="col-md-6 d-flex align-items-center">
        <div class="long-sejour text-center">
        <p>
        Laissez-vous envoûter par une expérience où le luxe se mêle à l'exclusivité pour créer des souvenirs inoubliables. 
        Chaque recoin de cette suite d'exception est imprégné d'une ambiance envoûtante, où le raffinement et la sophistication vous entourent, vous invitant à vous abandonner à un monde de pure indulgence et de plaisirs exquis.</p>
        </div>
    </div>
    <div class="col-md-6">
        <img src="image/suite_b_4.jpg" class="img-fluid" alt="fond">
    </div>
</div>
</div>
        </section>

    <?php include 'includes/logo.php'; ?>

</main>

    <?php include 'includes/footer.php'; ?>
    
</body>

</html>
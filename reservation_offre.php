<?php
session_start(); 

if (!isset($_SESSION['email'])) {
    header("Location: connexion.php");
    exit();
}

include 'includes/db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $date_debut = $_POST["date_debut"];
    $date_fin = $_POST["date_fin"];
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $nombre = $_POST["nombre"];
    $num = $_POST["num"];
    $nom_reservation = $_POST["nom_reservation"]; 

   
    if (strtotime($date_debut) < strtotime(date('Y-m-d'))) {
        echo "<div class='error'>Vous ne pouvez pas réserver une date antérieure à aujourd'hui.</div>";
    } elseif ($date_debut >= $date_fin) {
        echo "<div class='error'>La date de départ doit être postérieure à la date d'arrivée.</div>";
    } elseif ($nombre > 4) {
        echo "<div class='error'>Le nombre de personnes ne peut pas dépasser 4.</div>";
    } else {
        
        $query = "SELECT * FROM reservation_offres WHERE (date_debut <= '$date_debut' AND date_fin >= '$date_fin') OR (date_debut <= '$date_debut' AND date_fin >= '$date_debut') OR (date_debut >= '$date_debut' AND date_fin <= '$date_fin')";
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            echo "<div class='error'>La chambre est déjà réservée pour ces dates.</div>";
            
            
            $query = "SELECT MIN(date_fin) AS next_available_date FROM reservation_offres WHERE date_fin > '$date_fin'";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $next_available_date = $row['next_available_date'];
            
            if ($next_available_date) {
                echo "<div class='success'>La prochaine date disponible pour la réservation est le $next_available_date.</div>";
            }
        } else {
            
            $sql = "INSERT INTO reservation_offres (prenom, nom, email, num, nom_reservation, date_debut, date_fin, nombre) 
            VALUES ('$prenom', '$nom', '$email', '$num', '$nom_reservation', '$date_debut', '$date_fin','$nombre')";
        

            if ($conn->query($sql) === TRUE) {
                echo "<div class='success'>Réservation enregistrée avec succès.</div>";
                header("Location: https://buy.stripe.com/test_00g2aDgmr3Lxc6c8wB");
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
      <img src="image/suitemielhead.jpg" alt="fonds-header">

    </div>

    <section class="book">
    <div class="container flex">
        <div class="input grid">
        <div class="box">
                <form method="post">
                    <label>Prénom : </label>
                    <input type="text" name="prenom" placeholder="Prénom" required>
            </div>
        <div class="box">
                <form method="post">
                    <label>Nom  : </label>
                    <input type="text" name="nom" placeholder="Nom" required>
            </div>
            <div class="box">
                <form method="post">
                    <label>Date du début de la réservation : </label>
                    <input type="date" name="date_debut" placeholder="Date Début" required>
            </div>
            <div class="box">
                    <label>Date de la fin de la réservation : </label>
                    <input type="date" name="date_fin" placeholder="Date Fin" required>
            </div>
            <div class="box">
                <label>Nombres de personnes : </label><br>
                <input type="number" name="nombre" placeholder="0" required>
            </div>
            <div class="box">
                <label>Numéro de téléphone : </label>
                <input type="text" name="num" placeholder="00/00/00/00/00" required>
            </div>
            <div class="box">
                <label>Nom de la réservation :</label>
                <input type="text" name="nom_reservation" placeholder="Nom" required>
            </div>
            <div class="box">
                <label>Email :</label>
                <input type="text" name="email" placeholder="Email" required>
            </div>
            
            <div class="search">
                <button class="btn-reserve" type="submit">Réservez</button>
            </div>
            </form>
            </div>
    </div>
</section>

<section class="container">
    <h1>Suite Lune de miel </h1>
            <p>Voici la chambre de Lune de Miel pour un séjour au chaud et en toute intimité !.</p>
            <h2>600€</h2>
            <div class="container mt-5">
            <div class="row">
    <div class="col-md-6">
        <img src="image/suitemiel.webp" class="img-fluid" alt="fond">
    </div>
    <div class="col-md-6 d-flex align-items-center">
        <div class="long-sejour text-center">
        <p>

        Entrez dans une oasis de luxe et de sérénité avec notre suite nuptiale, nichée au cœur de notre hôtel de renommée internationale. 
        Chaque coin de l'espace a été pensé pour créer une expérience enveloppante alliant raffinement et confort. </p>
        </div>
    </div>
</div>
</div>

<div class="container mt-5">
            <div class="row">

    <div class="col-md-6 d-flex align-items-center">
        <div class="long-sejour text-center">
        <p> 
        Les nuances douces et les tissus délicats vous enveloppent dès votre arrivée, offrant un havre de paix où vous pourrez vous détendre et vous ressourcer.
         La suite spacieuse est dotée d'un lit king-size luxueux et d'une baignoire à remous pour des moments de pur bonheur à deux. </p>
        </div>
    </div>
    <div class="col-md-6">
        <img src="image/suitemiel1.webp" class="img-fluid" alt="fond">
    </div>
</div>
</div>

<div class="container mt-5">
            <div class="row">
    <div class="col-md-6">
        <img src="image/suitemiel2.webp" class="img-fluid" alt="fond">
    </div>
    <div class="col-md-6 d-flex align-items-center">
        <div class="long-sejour text-center">
        <p> 
        Les larges baies vitrées vous offrent une vue imprenable sur le paysage urbain ou les paysages pittoresques environnants, créant ainsi une toile de fond parfaite pour votre escapade romantique.
         Chaque détail, des draps soyeux aux accents délicats, est pensé pour vous offrir une expérience mémorable et inoubliable..</p>
        </div>
    </div>
</div>
</div>

<div class="container mt-5">
            <div class="row">
    <div class="col-md-6 d-flex align-items-center">
        <div class="long-sejour text-center">
        <p>
        Plongez dans l'élégance et le luxe de notre suite nuptiale, où chaque instant est une célébration de l'amour et de la complicité. 
        Laissez-vous emporter par la magie de cet espace intime, où les souvenirs précieux de votre lune de miel seront chéris pour les années à venir.</p>
        </div>
    </div>
    <div class="col-md-6">
        <img src="image/suitemiel3.webp" class="img-fluid" alt="fond">
    </div>
</div>
</div>
        </section>

    <?php include 'includes/logo.php'; ?>

</main>

    <?php include 'includes/footer.php'; ?>
    
</body>

</html>


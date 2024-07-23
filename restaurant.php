<?php

include 'includes/db.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PALASO</title>
  <link rel="stylesheet" href="restaurant.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
 
    <?php include 'includes/header.php'; ?>

  <main>

    <div class="fonds">
      <img src="image/restaurant.jpeg" alt="fonds-header">
    </div>
    <br><br>

    <section class="book">
    <div class="container flex">
        <div class="input grid">
            <div class="box">
                <form method="post">
                    <label>Date de la réservation : </label>
                    <input type="date" name="days" placeholder="Date Début" required>
            </div>
            <div class="box">
                <label>Heure de la réservation : </label>
                <input type="time" name="hours" placeholder="Heure" required>
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
            <button type="submit" class="btn-reserve button-reservation">Réservez</button>
            </form>
            </div>
        </div>
    </div>
</section>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $_POST['name'];
    $days = $_POST['days'];
    $hours = $_POST['hours'];
    $number = $_POST['number'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];

    
    if (strtotime($days) < strtotime(date('Y-m-d'))) {
        echo "<div class='error_message'>Vous ne pouvez pas réserver une date antérieure à aujourd'hui.</div>";
    } 
    
    elseif (!(strtotime($hours) >= strtotime('11:00:00') && strtotime($hours) <= strtotime('15:00:00')) && !(strtotime($hours) >= strtotime('19:00:00') && strtotime($hours) <= strtotime('22:00:00'))) {
        echo "<div class='error_message'>Les réservations ne sont autorisées qu'entre 11h et 15h, et entre 19h et 22h.</div>";
    } 
    
    elseif ($number > 8) {
        echo "<div class='error_message'>Le nombre de personnes ne peut pas dépasser 8.</div>";
    } else {
        
        $sql = "INSERT INTO reservation_resto (phone_number, name, days, hours, number, email) VALUES ('$phone_number', '$name', '$days', '$hours', '$number', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='success_message'>Réservation enregistrée avec succès.</div>";
        } else {
            echo "Erreur: " . $sql . "<br>" . $conn->error;
        }
    }
}


$conn->close();
?>

<div class="container">
            <div class="row justify-content-center mt-5">
                 <div class="col-md-3">
                     <form class="d-flex" role="search" action="index.php" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search" name="search_keyword" style="width: 200px; margin-top: 100px;">
                        <button class="btn btn-dark" type="submit" style="margin-top: 100px;">Rechercher</button>
                    </form>
                 </div>
            </div>
        </div>

    <div class="intro">
      <h1>PALASO RESTAURANT</h1>
      <h2>NOTRE RESTAURANT EST OUVERT A TOUS</h2><br>
      <h2>Horaires : 11h/15h et 19h/22h</h2><br>
      <p>Succombez à une expérience culinaire inoubliable au cœur de la gastronomie française, où chaque plat est une
        symphonie de saveurs raffinées et de traditions revisitées
        Le petit-déjeuner, le déjeuner et le dîner sont servis dans la grande salle à manger du PALASO et sous sa
        verrière. Le restaurant se prolonge dans le jardin.</p>
    </div>

    
    <div class="container">
    <div class="row mt-5">
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <img src="image/restaurant3.jpg" alt="fonds-header" class="img_resto img-fluid mx-auto d-block" style="max-width: 50%; margin-right: 15px;">
        </div>
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <img src="image/restaurant4.jpg" alt="fonds-header" class="img_resto img-fluid mx-auto d-block" style="max-width: 50%; margin-left: 15px;">
        </div>
    </div>
</div>



<div class="container text-center">
<div class="row mt-5">

<div class="col-12">
<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
</svg>
</div>
</div>
</div>

<div class="container text-center">
<div class="row mt-2">
    <div class="col-12">
    <p><a href="menu.php" style="color: black; text-decoration: none;">Découvrez votre menu</a></p>

    </div>
</div>
</div>


<?php include 'includes/logo.php'; ?>

    <?php include 'includes/footer.php'; ?>
    
</body>

</html>
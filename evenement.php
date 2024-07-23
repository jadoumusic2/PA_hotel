<?php

include 'includes/db.php';

$sql = "SELECT titre, image, description FROM evenement";
$result = $conn->query($sql);


if ($result) {
    
    $evenement = $result->fetch_assoc();
    $result->free(); 
} else {
    echo "Erreur lors de l'exécution de la requête : (" . $conn->errno . ") " . $conn->error;
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PALASO</title>
    <link rel="stylesheet" href="evenement.css">
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

        <section class="container">
            <h1>Évènements</h1>
            <p>Retrouvez ici les différents évènements qu'organise l'hôtel Palaso. Un évènement par soir !</p>
            <div class="container mt-5">
            <div class="row">
    <div class="col-md-6">
        <img src="<?php echo $evenement['image']; ?>" class="img-fluid" alt="fond">
    </div>
    <div class="col-md-6 d-flex align-items-center">
        <div class="long-sejour text-center">
            <h2><?php echo $evenement['titre']; ?></h2>
            <p><?php echo $evenement['description']; ?></p>
        </div>
    </div>
</div>
</div>
        </section>

      <?php include 'includes/logo.php'; ?>
      
</main>

      <?php include 'includes/footer.php'; ?>
      
      </body>
      </html>
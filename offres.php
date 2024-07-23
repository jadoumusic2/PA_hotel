<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PALASO</title>
  <link rel="stylesheet" href="offres.css">
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
      <img src="image/fond_contact.jpg" alt="fonds-header">

    </div>

    <div class="container">
            <div class="row justify-content-center mt-5">
                 <div class="col-md-3">
                     <form class="d-flex" role="search" action="index.php" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search" name="search_keyword" style="width: 200px;">
                        <button class="btn btn-dark" type="submit">Rechercher</button>
                    </form>
                 </div>
            </div>
        </div>
    
    <div class="intro">
      <h1>HOTEL PALASO</h1>
      <h2>Les Offres Du PALASO</h2>
      <p>L’hôtel PALASO propose différentes offres selon vos envies afin de vous offrir un séjour unique et inoubliable.
      </p>
    </div>

    <div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <img src="image/lunedemiel.avif" class="img-fluid" alt="fond">
    </div>
    <div class="col-md-6 d-flex align-items-center">
      <div class="long-sejour text-center">
        <h1>OFFRE LUNE DE MIEL </h1>
        <p>Découvrez notre offre spéciale "Lune de Miel" et créez des souvenirs inoubliables avec votre bien-aimé.
           Profitez de séjours romantiques dans des destinations de rêve, conçus exclusivement pour les nouveaux mariés.</p>
        <button type="button" class="btn btn-outline-dark button-offre">
        <a href="reservation_offre.php">Réservez</a>
        </button>
        
      </div>
    </div>
  </div>
</div>
    

<?php include 'includes/logo.php'; ?>

    <?php include 'includes/footer.php'; ?>
    
</body>

</html>
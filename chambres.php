<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PALASO</title>
  <link rel="stylesheet" href="chambres.css">
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
      <img src="image/fonds_chambre.webp" alt="fonds-header">
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
      <h2>Les Chambres / Suites Du PALASO</h2>
      <p>L’hôtel PALASO propose différentes offres de chambres et de suites qui seront adapté à votre confort et vos besoins.
      </p>
    </div>

    <div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <img src="image/chambre_familial.jpg" class="img-fluid" alt="fond">
    </div>
    <div class="col-md-6 d-flex align-items-center">
      <div class="long-sejour text-center">
        <h1>CHAMBRES FAMILIAL</h1>
        <p>Retrouvez, dans cette chambre de grande envergure, deux lits doubles si vous êtes avec votre enfant ou autres.</p>
        <h2>600€</h2>
        <a href="reservation_chambre_familial.php"><button type="button" class="btn btn-outline-dark">Réservez</button></a>
      </div>
    </div>
  </div>
</div>
    


    <div class="container mt-5 mb-5">
  <div class="row align-items-center">
    <div class="col-md-6">
      <div class="saint-valentin text-center">
        <h1>CHAMBRES ROMANCE</h1>
        <p>Un accueil romantique en chambre, venez vous ressourcez dans cette chambre avec votre conjoint ou conjointe pour ravivez la flamme du couple !</p>
        <h2>650€</h2>
        <a href="reservation_chambre_romance.php"><button type="button" class="btn btn-outline-dark">Réservez</button></a>
      </div>
    </div>
    <div class="col-md-6">
      <img src="image/chambres_romance.jpg" class="img-fluid" alt="fond">
    </div>
  </div>
</div>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <img src="image/chambres_luxe.jpg" class="img-fluid" alt="fond">
    </div>
    <div class="col-md-6 d-flex align-items-center">
      <div class="long-sejour text-center">
        <h1>CHAMBRES LUXE</h1>
        <p>Cette chambre est la meilleure que nous proposons. Avec vue sur la tour eiffel, cette chambre vous réservera de nombreuses autres surprises.</p>
        <h2>800€</h2>
        <a href="reservation_chambre_luxe.php"><button type="button" class="btn btn-outline-dark">Réservez</button></a>
      </div>
    </div>
  </div>
</div>

<div class="container mt-5 mb-5">
  <div class="row align-items-center">
    <div class="col-md-6">
      <div class="saint-valentin text-center">
        <h1>SUITES A</h1>
        <p>Voila notre premier type de suites. Cette offre peut s'adapter pour une ou plusieurs personnes. Composé de deux chambres et d'un grands espaces de vie,
            cette suite répondra à toutes vos attentes.
        </p>
        <h2>1000€</h2>
        <a href="reservation_suite_a.php"><button type="button" class="btn btn-outline-dark">Réservez</button></a>
      </div>
    </div>
    <div class="col-md-6">
      <img src="image/suites_a.jpg" class="img-fluid" alt="fond">
    </div>
  </div>
</div>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <img src="image/suites_luxe.jpg" class="img-fluid" alt="fond">
    </div>
    <div class="col-md-6 d-flex align-items-center">
      <div class="long-sejour text-center">
        <h1>SUITES B</h1>
        <p>Cette suite de luxe est l'endroit ou vous serez le mieux dans l'hôtel. Situé au dernier étage de ce dernier avec accès sur les toits et une vue sur Paris.</p>
        <h2>1200€</h2>
        <a href="reservation_suite_b.php"><button type="button" class="btn btn-outline-dark">Réservez</button></a>
      </div>
    </div>
  </div>
</div>


<?php include 'includes/logo.php'; ?>

    <?php include 'includes/footer.php'; ?>
    
</body>

</html>
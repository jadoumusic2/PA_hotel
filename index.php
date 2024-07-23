<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PALASO</title>
    <link rel="stylesheet" href="hôtel.css">
    <script src="index.js"></script>
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
            <img src="image/fonds-header.png" alt="fonds-header">
            <div class="container">
                <div class="row justify-content-center mt-5">
                    <div class="col-md-3">
                        <form class="d-flex" role="search" action="index.php" method="GET">
                            <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search"
                                name="search_keyword" style="width: 200px;">
                            <button class="btn btn-dark" type="submit">Rechercher</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="intro">
            <h1>L'HÔTEL PALASO BÉNÉFICIE D'UNE LOCALISATION EXCEPTIONNELLE</h1>
            <h2>L'HÔTEL PALASO, UN LUXUEUX "HÔTEL PARTICULIER" EN PLEIN COEUR DE PARIS</h2>
            <p>L'hôtel particulier Palaso a été transformé en 2024
                par Jade Keina, Rayane et Yanis, en un fabuleux hôtel 5 étoiles.
                Ce bijou caché situé dans Paris a conservé l'âme d'une demeure familiale. Situé en plein cœur de ville,
                cet hôtel dispose de 80 chambres dont 18 suites et offre des salons d'exception, un restaurant, un bar,
                un jardin privé et une salle de fitness.</p>
        </div>

        <div class="services">
            <div class="accueil1 accueil-item expanded" onmouseover="expandDiv(this)" onmouseout="resetDivs(this)">
                <a href="chambres.php">
                    <img src="image/accueil1.webp" alt="accueil1">
                    <p>Chambres et Suites</p>
                </a>
            </div>

            <div class="accueil2 accueil-item expanded" onmouseover="expandDiv(this)" onmouseout="resetDivs(this)">
                <a href="restaurant.php">
                    <img src="image/accueil2.webp" alt="accueil2">
                    <p>Restaurants et Terrasse</p>
                </a>
            </div>

            <div class="accueil3 accueil-item expanded" onmouseover="expandDiv(this)" onmouseout="resetDivs(this)">
                <a href="reunion.php">
                    <img src="image/accueil3.jpg" alt="accueil3">
                    <p>Salle de Réunion et Évènements</p>
                </a>
            </div>

            <div class="accueil4 accueil-item expanded" onmouseover="expandDiv(this)" onmouseout="resetDivs(this)">
                <a href="offres.php">
                    <img src="image/accueil4.jpg" alt="accueil4">
                    <p>Offres</p>
                </a>
            </div>
        </div>

        <?php include 'includes/logo.php'; ?>

    </main>

    <?php include 'includes/footer.php'; ?>

</body>

</html>

<?php


?>
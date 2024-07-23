<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PALASO</title>
    <link rel="stylesheet" href="suites.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<header>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">PALASO</a>
          <a class="navbar-brand" href="#"><button type="button" class="btn btn-outline-light">Réservation</button></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">MENU</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Chambres et Suites
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                      <li><a class="dropdown-item" href="chambres.php">Chambres</a></li>
                      <li><a class="dropdown-item" href="suites.php">Suites</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="restaurant.php">Restaurant</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Réunions et Evènements
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                      <li><a class="dropdown-item" href="reunion.php">Réunions</a></li>
                      <li><a class="dropdown-item" href="evenement.php">Evènements</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="offres.php">Offres</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="galerie.php">Galerie</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="presse.php">Presse et Actualités</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="plan.php">Plan et Accès</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="connexion.php">Connexion</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="inscription.php">Inscription</a>
                  </li>
              </ul>
              <form class="d-flex mt-3" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-warning" type="submit">Rechercher</button>
              </form>
            </div>
          </div>
        </div>
      </nav>

      </header>

      <main>
        <div class="logo">
          <img src="image/logo.png" alt="logo">
      </div>

      <div class="coordonnées">
          <p>21 rue Errard 75012</p>
          <a href="page_téléphone">+33637745612</a>
          <a href="page_mail">hotel.palaso@gmail.com</a>
      </div>

      <div class="reseau">
          <a href="page_instagram">
          <img src="image/instagram.png" alt="instagram">
          </a> 
          <a href="page_facebook">
          <img src="image/facebook.png" alt="facebook">
          </a>
          <a href="page_twitter">
          <img src="image/twitter.png" alt="twitter">
          </a>

      </div>

      <footer>
        <div class="bas">
            <a href="page_Développement_Durable">Développement Durable</a>
            <a href="page_Mention_Légale">Mention Légale</a>
            <a href="page_Carrière">Carrière</a>
            <a href="page_Politique_et_Confidentialité">Politique et Confidentialité</a>
            <a href="page_Langue">Fr</a>
        </div>
        </footer>
      </body>
      </html>
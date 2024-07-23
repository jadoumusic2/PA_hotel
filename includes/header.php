<?php

if (isset($_GET['search_keyword'])) {
    
    $keyword = strtolower($_GET['search_keyword']); 

    
    $keywords_to_pages = array(
        "accueil" => "index.php",
        "chambres" => "chambres.php",
        "chambre" => "chambres.php",
        "suites" => "chambres.php",
        "suite" => "chambres.php",
        "réunions" => "reunion.php",
        "réunion" => "reunion.php",
        "évènements" => "evenement.php",
        "évènement" => "evenement.php",
        "offres" => "offres.php",
        "offre" => "offres.php",
        "newsletter" => "presse.php",
        "contact" => "contact.php",
        "restaurant" => "restaurant.php",
        "menu" => "menu.php"
    );

    
    if (isset($keywords_to_pages[$keyword])) {
        
        header("Location: " . $keywords_to_pages[$keyword]);
        exit; 
    } else {
        
        
        header("Location: index.php");
        exit;
    }
}
?>

<script src="https:
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<?php include 'includes/connexion_check.php'; ?>
<style>
    body {
        font-family: 'Old Standard TT', serif;
    }

    .btn-nav {
        background-color: transparent;
        padding: 10px 20px;
        border-radius: 5px;
        position: relative;
    }

    .navbar-custom {
        background-color: rgb(27, 26, 26);
    }

    .menu-back {
        background-color: rgb(27, 26, 26);
    }

    .offcanvas-title {
        color: #fff;
    }

    .navbar-brand {
        font-size: 1.6rem;
        color: rgb(158, 138, 26);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .navbar-brand .hotel-particulier {
        font-size: 1.2rem;
    }

    .nav-link {
        font-size: 1.1rem;
        color: #fff;
    }

    .nav-link:hover {
        color: #ccc;
    }

    .navbar-toggler-icon {
        color: white;
    }

    .navbar-toggler {
        border-color: white;
    }

    .navbar-toggler:focus,
    .navbar-toggler:active,
    .navbar-toggler:hover {
        outline: none;
    }

    .form-control {
        font-size: 1.1rem;
    }

    .btn-outline-light,
    .btn-dark {
        font-size: 1.1rem;
    }
</style>
<header>
    <nav class="navbar navbar-dark navbar-custom fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="chambres.php"><button type="button"
                    class="btn btn-outline-light">Réservation</button></a>
            <a class="navbar-brand" href="index.php">
                PALASO
                <span class="hotel-particulier">Hôtel particulier</span>
            </a>
            <button class="navbar-toggler btn-nav" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end menu-back" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">MENU</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="chambres.php">Chambres et Suites</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="restaurant.php">Restaurant</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reunion.php">Réunions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="evenement.php">Evènements</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="offres.php">Offres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="presse.php">Newsletter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <?php if ($connected): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="chat.php">Chat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="profile.php">Mon profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="deconnexion.php">Deconnexion</a>
                            </li>
                            <?php if ($role == 1 || $role == 2): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="espaceAdmin/index.php">Accueil Administrateur</a>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="connexion.php">Connexion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="inscription.php">Inscription</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <form class="d-flex mt-3" role="search" action="index.php" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search"
                            name="search_keyword">
                        <button class="btn btn-dark" type="submit">Rechercher</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</header>

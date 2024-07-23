<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Administrateur</title>
    <style>
        .link-container {
            border: 2px solid #ccc; 
            border-radius: 5px; 
            padding: 10px; 
            margin-bottom: 10px; 
            background-color: #f9f9f9; 
            transition: all 0.3s ease; 
            width: 300px; 
            margin-right: 10px; 
            float: left; 
        }

        .link-container:hover {
            background-color: #e9e9e9; 
        }


        .link-container button {
            background-color: #4CAF50; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            padding: 10px 20px; 
            text-align: center; 
            text-decoration: none; 
            display: inline-block; 
            font-size: 16px; 
            cursor: pointer; 
        }

        .link-container button:hover {
            background-color: #45a049; 
        }

        h1 {
            text-align: center
        }

    </style>
    
</head>
<body>
    <h1 class="h1">Espace administrateur</h1>
    <nav class="nav">
        <ul>
            <p>
                <div class="link-container">
                    Accueil<br><br>
                    <button onclick="window.location.href='index.php'">Accueil</button>
                </div>
            </p>
            <p>
                <div class="link-container">
                    Afficher tous les membres<br><br>
                    <button onclick="window.location.href='membres.php'">Afficher tous les membres</button>
                </div>
            </p>
            <p>
                <div class="link-container">
                    Captcha questions/réponses<br><br>
                    <button onclick="window.location.href='captcha.php'">Captcha questions/réponses</button>
                </div>
            </p>
            <p>
                <div class="link-container">
                    Réservation du restaurant<br><br>
                    <button onclick="window.location.href='resto.php'">Réservation du restaurant</button>
                </div>
            </p>
            <p>
                <div class="link-container">
                    Génération des menus<br><br>
                    <button onclick="window.location.href='generation_menu.php'">Génération des menus</button>
                </div>
            </p>
            <p>
                <div class="link-container">
                    Voir les menus<br><br>
                    <button onclick="window.location.href='menu.php'">Voir les menus</button>
                </div>
            </p>
            <p>
                <div class="link-container">
                    Réservation des chambres<br><br>
                    <button onclick="window.location.href='reservation_chambre.php'">Réservation des chambres</button>
                </div>
            </p>
            <p>
                <div class="link-container">
                    Offre<br><br>
                    <button onclick="window.location.href='offre.php'">Offre</button>
                </div>
            </p>
            <p>
                <div class="link-container">
                    Salle de réunion<br><br>
                    <button onclick="window.location.href='reunion.php'">Salle de réunion</button>
                </div>
            </p>
            <p>
                <div class="link-container">
                    Evenement<br><br>
                    <button onclick="window.location.href='evenement.php'">Evenement</button>
                </div>
            </p>
            <p>
                <div class="link-container">
                    Message des utilisateurs<br><br>
                    <button onclick="window.location.href='message_utilisateur.php'">Message des utilisateurs</button>
                </div>
            </p>
            <p>
                <div class="link-container">
                    Chat<br><br>
                    <button onclick="window.location.href='chat.php'">Chat</button>
                </div>
            </p>
        </ul>
    </nav>

    <button><a href="logout.php" style="color:red; text-decoration:none;">Déconnexion</a></button>
    
</body>
</html>

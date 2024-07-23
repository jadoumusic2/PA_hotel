<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PALASO</title>
    <link rel="stylesheet" href="contact.css">
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
                        <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search" name="search_keyword" style="width: 200px; margin-bottom: 20px;">
                        <button class="btn btn-outline-warning" type="submit" style="margin-bottom: 20px;">Rechercher</button>
                    </form>
                </div>
            </div>
        </div>

        <?php


error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'includes/db.php';

  
    $email = $_POST['email'];
    $nom = $_POST['nom'];
    $numero_telephone = $_POST['numero_telephone'];
    $priorite = $_POST['priorite'];
    $message = $_POST['message'];

   
    $sql = "INSERT INTO contact (email, nom, numero_telephone, priorite, message) VALUES (?, ?, ?, ?, ?)";

   
    $stmt = $conn->prepare($sql);

   
    $stmt->bind_param("sssss", $email, $nom, $numero_telephone, $priorite, $message);

    
    if ($stmt->execute()) {
        echo "<div class='succes'>Message transmis avec succès. <br> Nous vous recontactons dans les plus bref délais.</div>";
    } else {
        echo "<div class='erreur'>Erreur lors de la transmission : " . $conn->error. "</div>";
    }

    
    $stmt->close();
}

?>

        <section class="container">
            <h1>Coordonnées de contact</h1>
            <p>Numéro de téléphone : +33637745612</p>
            <p>Adresse e-mail : contact@palaso.com</p>
            <p>Adresse : 123 Rue de la République, 75001 Paris, France</p>

            <h2>Formulaire de contact</h2>
            <form method="post">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" name="nom" placeholder="Votre nom" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" name="email" placeholder="Votre e-mail" required>
                </div>
                <div class="form-group">
                    <label for="numero_telephone">Numéro de téléphone</label>
                    <input type="tel" class="form-control" name="numero_telephone" placeholder="Votre numéro de téléphone" required>
                </div>
                <div class="form-group">
                    <label for="priorite">Priorité</label>
                    <select class="form-select" name="priorite" required>
                        <option value="Haute">Haute</option>
                        <option value="Moyenne">Moyenne</option>
                        <option value="Basse">Basse</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" name="message" rows="3" placeholder="Quelle est votre problème :" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

</body>
</html>

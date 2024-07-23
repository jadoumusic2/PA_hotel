<?php
session_start(); 

include 'includes/db.php'; 

if (!isset($_SESSION['email'])) {
    header('Location: connexion.php');
    exit();
}

$email = $_SESSION['email'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservation_id = $_POST['reservation_id'];
    $reservation_type = $_POST['reservation_type'];

    if ($reservation_type === 'chambre') {
        $sql_delete = "DELETE FROM chambre_luxe WHERE email = ?
                       UNION
                       DELETE FROM chambre_romance WHERE email = ?
                       UNION
                       DELETE FROM chambre_familial WHERE email = ?
                       UNION
                       DELETE FROM suites_a WHERE email = ?
                       UNION
                       DELETE FROM suites_b WHERE email = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("sssss",  $email, $email, $email, $email, $email);
    } elseif ($reservation_type === 'restaurant') {
        $sql_delete = "DELETE FROM reservation_resto WHERE id = ? AND email = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("is", $reservation_id, $email);
    }

    if ($stmt_delete->execute()) {
        $message = "Réservation supprimée";
    } else {
        $message = "Erreur lors de la suppression de la réservation";
    }

    $stmt_delete->close();
}


$sql_user = "SELECT nom, prenom, telephone, email FROM utilisateurs WHERE email = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("s", $email);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();

if (!$user) {
    header('Location: connexion.php?message=Utilisateur non trouvé');
    exit();
}


$sql_reservation = "SELECT * FROM (
                        SELECT 'chambre_luxe' AS chambre, id, arrival_days, depart_days FROM chambre_luxe WHERE email = ? 
                        UNION 
                        SELECT 'chambre_romance' AS chambre, id, arrival_days, depart_days FROM chambre_romance WHERE email = ? 
                        UNION 
                        SELECT 'chambre_familial' AS chambre, id, arrival_days, depart_days FROM chambre_familial WHERE email = ? 
                        UNION 
                        SELECT 'suites_a' AS chambre, id, arrival_days, depart_days FROM suites_a WHERE email = ? 
                        UNION 
                        SELECT 'suites_b' AS chambre, id, arrival_days, depart_days FROM suites_b WHERE email = ?
                    ) AS reservations";

$stmt_reservation = $conn->prepare($sql_reservation);
$stmt_reservation->bind_param("sssss", $email, $email, $email, $email, $email);
$stmt_reservation->execute();
$result_reservation = $stmt_reservation->get_result();
$reservation = $result_reservation->fetch_assoc();


$sql_restaurant = "SELECT id, days, hours, number FROM reservation_resto WHERE email = ?";
$stmt_restaurant = $conn->prepare($sql_restaurant);
$stmt_restaurant->bind_param("s", $email);
$stmt_restaurant->execute();
$result_restaurant = $stmt_restaurant->get_result();
$restaurant_reservation = $result_restaurant->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style_profile.css">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Profil de l'utilisateur</h4>
            </div>
            <div class="card-body">
                <?php if (isset($message)) : ?>
                    <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
                <?php endif; ?>
                <p><strong>Nom:</strong> <?php echo htmlspecialchars($user['nom']); ?></p>
                <p><strong>Prénom:</strong> <?php echo htmlspecialchars($user['prenom']); ?></p>
                <p><strong>Téléphone:</strong> <?php echo htmlspecialchars($user['telephone']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <?php if ($reservation) : ?>
                    <p><strong>Chambre Réservée:</strong> <?php echo htmlspecialchars($reservation['chambre']); ?></p>
                    <p>Date d'arrivée: <?php echo htmlspecialchars($reservation['arrival_days']); ?></p>
                    <p>Date de départ: <?php echo htmlspecialchars($reservation['depart_days']); ?></p>
                    <form method="POST" action="">
                        <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars($reservation['id']); ?>">
                        <input type="hidden" name="reservation_type" value="chambre">
                    
                    </form>
                <?php else : ?>
                    <p>Aucune chambre réservée.</p>
                <?php endif; ?>
                <?php if ($restaurant_reservation) : ?>
                    <p><strong>Réservation de Restaurant:</strong></p>
                    <p>Date: <?php echo htmlspecialchars($restaurant_reservation['days']); ?></p>
                    <p>Heure: <?php echo htmlspecialchars($restaurant_reservation['hours']); ?></p>
                    <p>Nombre de Personnes: <?php echo htmlspecialchars($restaurant_reservation['number']); ?></p>
                    <form method="POST" action="">
                        <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars($restaurant_reservation['id']); ?>">
                        <input type="hidden" name="reservation_type" value="restaurant">
                        
                    </form>
                <?php else : ?>
                    <p>Aucune réservation de restaurant.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</body>
</html>

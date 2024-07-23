<?php
require 'includes/db.php'; 

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verify'])) {
    $email = $_POST['email'];
    $token = $_POST['token'];

    
    $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $storedToken = $user['token'];
        $confirmationTimestamp = strtotime($user['confirmation_timestamp']);
        $currentTimestamp = time();
        
        
        if ($currentTimestamp - $confirmationTimestamp <= 300) {
           
            if ($token === $storedToken && $user['isActive'] == 0) {
                
                $updateStmt = $conn->prepare("UPDATE utilisateurs SET isActive = 1, token = NULL WHERE email = ?");
                $updateStmt->bind_param("s", $email);
                if ($updateStmt->execute()) {
                    $message = "Votre compte a été activé avec succès!";
                } else {
                    $message = "Erreur lors de l'activation du compte.";
                }
            } else {
                $message = "Lien invalide ou compte déjà activé.";
            }
        } else {
            $message = "Le lien de confirmation a expiré. Cliquez ici pour <a href='resend_confirmation.php?email=$email'>renvoyer le mail de confirmation</a>.";
        }
    } else {
        $message = "Lien invalide ou compte déjà activé.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmer votre compte</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('image/fonds.jpg');
            background-size: cover;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 600px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <main>
        <div class="container">
            <h1>Confirmer votre inscription</h1>
            <?php
            if (!empty($message)) {
                echo '<div class="alert alert-info">' . $message . '</div>';
            }
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['email']) && isset($_GET['token'])) {
                $email = urldecode($_GET['email']);
                $token = urldecode($_GET['token']);
                echo '<form action="verify.php" method="post">
                          <input type="hidden" name="email" value="' . htmlspecialchars($email) . '">
                          <input type="hidden" name="token" value="' . htmlspecialchars($token) . '">
                          <button type="submit" name="verify" class="btn btn-primary">Activer mon compte</button>
                      </form>';
            }
            ?>
        </div>
    </main>
</body>
</html>

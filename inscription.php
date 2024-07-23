<?php
require 'includes/db.php'; 
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $nom = $_POST['Nom'];
    $prenom = $_POST['Prenom'];
    $telephone = $_POST['Numéro_de_téléphone'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $mot_de_passe_confirm = $_POST['mot_de_passe_confirm'];

    
    if ($mot_de_passe !== $mot_de_passe_confirm) {
        $message = "Les mots de passe ne correspondent pas.";
    } else {
     
        if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $mot_de_passe)) {
            $message = "Le mot de passe doit contenir au moins une majuscule, un chiffre et avoir une longueur minimale de 8 caractères.";
        } else {
            $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
            $token = password_hash($mot_de_passe, PASSWORD_DEFAULT); 
            $confirmationTimestamp = date('Y-m-d H:i:s'); 
            
            $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $message = "Cet email existe déjà !";
            } else {
                $stmt = $conn->prepare("INSERT INTO utilisateurs (nom, prenom, telephone, email, mot_de_passe, token, confirmation_timestamp) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $nom, $prenom, $telephone, $email, $mot_de_passe_hash, $token, $confirmationTimestamp);
                if ($stmt->execute()) {
                    $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host = 'mail.tactinet.fr';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'hotelPalaso@tactinet.fr';
                        $mail->Password = 'Yanihaouili@200';  
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;

                        $mail->setFrom('hotelPalaso@tactinet.fr', 'Hotel Palaso');
                        $mail->addAddress($email);
                        $mail->isHTML(true);
                        $mail->Subject = 'Confirmation de votre email';
                        $mail->Body = '<html><body><div align="center"><h1>Confirmation d\'inscription</h1><p>Pour activer votre compte, veuillez cliquer sur le lien suivant: <a href="https://hotelpalaso.uk/verify.php?email=' . urlencode($email) . '&token=' . urlencode($token) . '">Activer mon compte</a>.</p></div></body></html>';

                        $mail->send();
                        $message = "Inscription réussie ! Veuillez vérifier votre email pour confirmer votre compte.";
                    } catch (Exception $e) {
                        $message = "Inscription réussie, mais l'envoi de l'email de vérification a échoué. Erreur de Mailer: " . $mail->ErrorInfo;
                    }
                } else {
                    $message = "Erreur: " . $stmt->error;
                }
                $stmt->close();
                $conn->close();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="submit"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .message {
            text-align: center;
            margin-top: 20px;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
<?php include 'includes/header.php'; ?>
    <main>
        <div class="container">
            <h1>Inscription</h1>
            <?php if (!empty($message)): ?>
            <p class="message <?php echo (strpos($message, 'réussie') !== false) ? 'success' : 'error'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </p>
            <?php endif; ?>
            <form method="post" action="">
                <input type="text" name="Nom" placeholder="Votre nom" required>
                <input type="text" name="Prenom" placeholder="Votre prénom" required>
                <input type="text" name="Numéro_de_téléphone" placeholder="Votre numéro de téléphone" required>
                <input type="email" name="email" placeholder="Votre email" required>
                <input type="password" name="mot_de_passe" placeholder="Votre mot de passe" required>
                <input type="password" name="mot_de_passe_confirm" placeholder="Confirmez votre mot de passe" required>
                <input type="submit" name="submit" value="Inscription">
                <p><a href="connexion.php" class="link-primary">Vous possédez un compte? Connectez-vous</a></p>
            </form>
        </div>
    </main>
</body>

</html>

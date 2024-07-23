<?php
require 'includes/db.php'; 
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['email'])) {
    $email = $_GET['email'];

    
    $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
       
        if ($user['isActive'] == 0) {
           
            $token = password_hash($user['mot_de_passe'], PASSWORD_DEFAULT);

            
            $confirmationTimestamp = date('Y-m-d H:i:s');
            $updateStmt = $conn->prepare("UPDATE utilisateurs SET token = ?, confirmation_timestamp = ? WHERE email = ?");
            $updateStmt->bind_param("sss", $token, $confirmationTimestamp, $email);
            $updateStmt->execute();

           
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
                $message = "Nouvel e-mail de confirmation envoyé avec succès.";
            } catch (Exception $e) {
                $message = "Erreur lors de l'envoi du nouvel e-mail de confirmation. Erreur de Mailer: " . $mail->ErrorInfo;
            }
        } else {
            $message = "Votre compte est déjà activé.";
        }
    } else {
        $message = "Aucun utilisateur trouvé avec cet e-mail.";
    }
} else {
    $message = "Paramètres manquants.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renvoi de confirmation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <?php if (!empty($message)): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>
        <a href="connexion.php" class="btn btn-primary">Retour à la page de connexion</a>
    </div>
</body>
</html>

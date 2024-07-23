<?php
session_start(); 

if (!isset($_SESSION['email'])) {
    header("Location: connexion.php");
    exit();
}

if ($_SESSION['role'] !== 1 && $_SESSION['role'] !== 2) {
    header("Location: connexion.php");
    exit();
}

$user = $_SESSION['email']; 

include '../includes/db.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Admin - CHAT</title>
    <link rel="stylesheet" href="chat.css">
</head>
<body>
    <div class="chat">
        <div class="button-email">
            <span> <?=$user?> </span>
            <a href="deconnexion.php" class="Deconnexion_btn">Déconnexion</a>
        </div>
        
        <div class="messages_box"> Chargement ...</div>
        

        <?php
            
            if (isset($_POST['send'])) {
                
                $message = $_POST['message'];
                
                if (isset($message) && $message != "") {
                    
                    $sql = "INSERT INTO messages (email, msg, date) VALUES (?, ?, NOW())";
                    
                    $stmt = $conn->prepare($sql);
                    
                    $stmt->bind_param("ss", $user, $message);
                    
                    if ($stmt->execute()) {
                        
                        header('location:chat.php');
                    } else {
                        echo "Erreur : " . $sql . "<br>" . $conn->error;
                    }
                    
                    $stmt->close();
                } else {
                    
                    header('location:chat.php');
            }
        }
        ?>
        
        <form action= "" class="send_message" method="POST">
             <textarea name="message" cols="30" rows="2" placeholder="Votre message"></textarea>
             <input type="submit" value="Envoyé" name="send">
             <a href="index.php" class="Accueil_btn">Accueil</a>
        </form>
    </div>

    <script>
        
        var message_box = document.querySelector('.messages_box');
        setInterval(function(){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    message_box.innerHTML = this.responseText;
                }
            };
            xhttp.open("GET","messages.php" , true); 
            xhttp.send()
        },500) 
    </script>
</body>
</html>

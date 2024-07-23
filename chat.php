<?php 
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: connexion.php');
    exit();
}
$user = $_SESSION['email']; 

include 'includes/db.php'; 


if(isset($_GET['search_keyword'])) {
    
    $keyword = strtolower($_GET['search_keyword']); 

    
    $keywords_to_pages = array(
        "accueil" => "index.php",
        "chambres" => "chambres.php",
        "chambre" => "chambres.php",
        "suites" => "chambres.php",
        "suite" => "chambres.php",
        "réunions" => "reunion.php",
        "réunion" => "reunion.php",
        "évènements" => "reunion.php",
        "évènement" => "reunion.php",
        "offres" => "offres.php",
        "offre" => "offres.php",
        "newsletter" => "presse.php",
        "contact" => "contact.php",
        "restaurant" => "restaurant.php",
        "menu" => "menu.php"
    );

    
    if(isset($keywords_to_pages[$keyword])) {
        
        header("Location: " . $keywords_to_pages[$keyword]);
        exit; 
    } else {
        
        
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?=$user?> | CHAT</title>
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
           
           if(isset($_POST['send'])){
               
               $message = $_POST['message']; 
               
               if(isset($message) && $message != ""){
                   
                   $sql = "INSERT INTO messages (email, msg, date) VALUES ('$user', '$message', NOW())";
                   if ($conn->query($sql) === TRUE) {
                       
                       header('location:chat.php');
                   } else {
                       echo "Erreur : " . $sql . "<br>" . $conn->error;
                   }
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
        <form class="recherche" role="search" action="index.php" method="GET">
                        <input class="write" type="search" placeholder="Rechercher" aria-label="Search" name="search_keyword" style="width: 200px; margin-right: 3px;">
                        <button class="recherche_btn" type="submit">Rechercher</button>
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
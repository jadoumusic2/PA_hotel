
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        .h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1 class="h1">Espace administrateur</h1>
    <li><a href="membres.php">Afficher tous les membres</a></li>
    <li><a href="log.php">Nombres de visites et de connexion</a></li>
    <li><a href="test.php">Captcha questions/réponses</a></li>
</body>
</html>

<?php
$bdd = new PDO('mysql:host=58.38.33.8;dbname=ProjetA', 'root', 'root');

$temps_session = 15;
$temps_actuel = date("U");
$user_ip = $_SERVER['REMOTE_ADDR'];

$req_ip_exist = $bdd->prepare('SELECT * FROM online WHERE user_ip = ?');
$req_ip_exist->execute(array($user_ip));
$ip_exist = $req_ip_exist->rowCount();

if($ip_exist == 0) {
    $add_ip = $bdd->prepare('INSERT INTO online (user_ip,time) VALUES (?,?)');
    $add_ip->execute(array($user_ip,$temps_actuel));
} else {
    $update_ip = $bdd->prepare('UPDATE online SET time = ? WHERE user_ip = ?');
    $update_ip->execute(array($temps_actuel,$user_ip));
}

$session_delete_time = $temps_actuel - $temps_session;

$del_ip = $bdd->prepare('DELETE FROM online WHERE time < ?');
$del_ip->execute(array($session_delete_time));

$show_user_nbr = $bdd->query('SELECT * FROM online');
$user_nbr = $show_user_nbr->rowCount();

?>

<p> Le nombre de visiteur est <?php echo $user_nbr; ?> et son adresse ip est <?php echo $user_ip; ?> </p>






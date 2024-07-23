<?php
session_start(); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'includes/db.php';
include 'includes/connexion_check.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $captcha_response = $_POST['captcha_response'];

   
    if (isset($_SESSION['captcha_answer']) && strtolower($captcha_response) !== strtolower($_SESSION['captcha_answer'])) {
        header("Location: connexion.php?message=Réponse au captcha incorrecte !");
        exit();
    }

    $sql = $conn->prepare("SELECT id FROM utilisateurs WHERE email=? AND banni=1");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        header("Location: connexion.php?message=Utilisateur interdit d'accès !");
    } else {
        $sql = "SELECT * FROM utilisateurs WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($mot_de_passe, $row['mot_de_passe'])) {
                if ($row['isActive'] == 1) {
                    $_SESSION['email'] = $email;
                    $_SESSION['role'] = $role;
                    $session_id = session_id();

                    $sql_check_session_id = "SELECT * FROM connexion WHERE session_id = '$session_id'";
                    $result_check_session_id = $conn->query($sql_check_session_id);

                    if ($result_check_session_id->num_rows == 0) {
                        $mot_de_passe_hash = $row['mot_de_passe'];
                        $sql_insert = "INSERT INTO connexion (email, mot_de_passe_hash, session_id) VALUES ('$email', '$mot_de_passe_hash', '$session_id')";
                        $conn->query($sql_insert);
                    }
                    header("Location: index.php");
                    exit();
                } else {
                    header("Location: connexion.php?message=Votre compte n'est pas activé. Veuillez vérifier votre email pour activer votre compte.");
                    exit();
                }
            } else {
                header("Location: connexion.php?message=Mot de passe incorrect !");
                exit();
            }
        } else {
            header("Location: connexion.php?message=Email incorrect !");
            exit();
        }
    }
}

$sql_captcha = "SELECT question, reponse FROM captcha ORDER BY RAND() LIMIT 1";
$result_captcha = $conn->query($sql_captcha);

if ($result_captcha->num_rows > 0) {
    $row_captcha = $result_captcha->fetch_assoc();
    $_SESSION['captcha_question'] = $row_captcha['question'];
    $_SESSION['captcha_answer'] = $row_captcha['reponse'];
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style_connexion.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <main>
        <div class="container">
            <h1>Connexion</h1>
            <?php
            if (isset($_GET['message']) && !empty($_GET['message'])) {
                echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
            }
            ?>
            <form method="post" action="">
                <input class="mt-3" type="email" name="email" placeholder="Votre email"
                    value="<?= isset($_COOKIE['email']) ? $_COOKIE['email'] : ''; ?>">
                <input class="mt-3" type="password" name="mot_de_passe" placeholder="Votre mot de passe"><br>
              
                <?php
                if (isset($_SESSION['captcha_question'])) {
                    echo '<p>' . $_SESSION['captcha_question'] . '</p>';
                }
                ?>
                
                <input class="mt-3" type="text" name="captcha_response" placeholder="Réponse au captcha">
                <input class="mt-3" type="submit" name="submit" value="Connexion">
                <p><a href="inscription.php"
                        class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover position-absolute  start-50 translate-middle-x">Vous
                        n'avez pas de compte? Inscrivez-vous</a></p>
            </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>

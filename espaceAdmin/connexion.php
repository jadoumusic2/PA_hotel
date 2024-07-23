<?php
session_start(); 

include '../includes/db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    
    $stmt = $conn->prepare("SELECT mot_de_passe, role FROM utilisateurs WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($hashed_password, $role);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role;

        
        if ($role == 1 || $role == 2) {
            header("Location: index.php");
            exit();
        } else {
            echo "<div class='error'>Vous n'êtes pas un administrateur.</div>";
        }
    } else {
        
        echo "<div class='error'>Nom d'utilisateur ou mot de passe incorrect.</div>";
    }

    $stmt->close();
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Admin - Connexion</title>
    <style>
        .centre {
            text-align: center;
        }
        input[type='submit'] {
            padding: 10px 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 12px;
        }
        .error {
            color: red;
            margin-top: 20px;
            text-align: center;
        }
        .success {
            color: green;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="centre">
    <form action="" method="post">
        <h1>Connexion</h1>
        <input type="text" id="email" name="email" placeholder="Email" required><br><br>
        <input type="password" id="password" name="password" placeholder="Mot de passe" required><br><br>
        <input type="submit" value="Se connecter">
    </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PALASO</title>
    <link rel="stylesheet" href="presse.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <script src="https://kit.fontawesome.com/617e155745.js" crossorigin="anonymous"></script> 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> 

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rakkas&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <?php include 'includes/header.php'; ?>

    <div class="container">
          <?php
            
            include 'includes/db.php';

            
            if ($conn->connect_error) {
              die("La connexion à la base de données a échoué : " . $conn->connect_error);
            }

          
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
             
              $email = $_POST["email"];

             
              if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Adresse e-mail invalide";
              } else {
                
                $sql = "INSERT INTO newsletter (email) VALUES ('$email')";
                if ($conn->query($sql) === TRUE) {
                  echo "Vous êtes maintenant inscrit à la newsletter";
                } else {
                  echo "Erreur : " . $sql . "<br>" . $conn->error;
                }
              }
            }

           
            $conn->close();
          ?>        

          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <h1>Joins notre Newsletter</h1>
            <p> Faites progresser notre établissement et restez à la page !</p>
            <div class="email-box">
              <i class='bx bxs-envelope' style='color:#ffffff' ></i>
              <input class="tbox" type="email" name="email" placeholder="Entrez votre email" required>
              <button class="btn" type="submit"> OUI , je m'abonne !</button> 
            </div>
          </form>
      </div>



  <?php include 'includes/footer.php'; ?>
  
      </body>
      </html>

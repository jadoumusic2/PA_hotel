<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PALASO</title>
  <link rel="stylesheet" href="menu.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
 
    <?php include 'includes/header.php'; ?>

  <main>
    <div class="menu">
      <h1 class="menu-title">Menu du Midi</h1>
      <ul>
        <?php
          
          include 'includes/db.php';
          
          $sql_midi = "SELECT entre, plat, fromage, dessert, prix_menu FROM menu_midi";
          $result_midi = $conn->query($sql_midi);

          if ($result_midi->num_rows > 0) {
              
              while($row = $result_midi->fetch_assoc()) {
                  echo "<li><strong>Entrée:<br></strong> " . $row["entre"] . "<br><br>
                            <strong>Plat:<br></strong> " . $row["plat"] . "<br><br>
                            <strong>Fromage:<br></strong> " . $row["fromage"] . "<br><br>
                            <strong>Dessert:<br></strong> " . $row["dessert"] . "<br><br>
                            <strong>Prix du menu :<br></strong> " . $row["prix_menu"] . "€</li>";
              }
          } else {
              echo "Aucun résultat trouvé.";
          } 
        ?>
      </ul>
    </div>
    
    <div class="menu">
      <h1 class="menu-title">Menu du Soir</h1>
      <ul>
        <?php
         
          $sql_soir = "SELECT entre, plat, fromage, dessert, prix_menu FROM menu_soir";
          $result_soir = $conn->query($sql_soir);

          if ($result_soir->num_rows > 0) {
              
              while($row = $result_soir->fetch_assoc()) {
                echo "<li><strong>Entrée:<br></strong> " . $row["entre"] . "<br><br>
                            <strong>Plat:<br></strong> " . $row["plat"] . "<br><br>
                            <strong>Fromage:<br></strong> " . $row["fromage"] . "<br><br>
                            <strong>Dessert:<br></strong> " . $row["dessert"] . "<br><br>
                            <strong>Prix du menu :<br></strong> " . $row["prix_menu"] . "€</li>";
              }
          } else {
              echo "Aucun résultat trouvé.";
          }
          $conn->close();
        ?>
      </ul>
    </div>
  </main>
  <?php include 'includes/footer.php'; ?>
</body>
</html>

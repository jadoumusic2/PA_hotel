<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PALASO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="chambre_offre.css">
  </head>
<body>
   
    <?php include 'includes/header.php'; ?>



      
    <div class="fonds">
      <img src="image/luxe2.jpg" alt="fonds-header">

    </div>


  <div class="section__container">
        <p class="section__subheader">CHAMBRES - LONG SEJOURS</p>
        <h2 class="section__header">OFFRE EXCEPTIONNEL !!</h2>
        <div class="row room__grid">


    

       

            <div class="mt-4 col-md-6">
                <div class="room__card">
                <img src="image/longsejour3.jpg" alt="room" />
                    <div class="room__card__details">
                        <div class="room__content">
                        <h4 class = "colonne" >Chambre Standard avec lit King Size</h4>
                        </div>
                        <div class="room__content">
                            <p >Chambre Standard avec lit King Size.</p>
                        </div>
                        <div class="room__content">
                        <h3 class= "colonne" >$599/nuits</h3>
                        </div>
                        <div class="room__content">
                        <a href="reservation_offre.php" class="btn btn-primary">Réserver</a>
                        </div>
                    </div>
                </div>
            </div>
        
        
  

    <div class="mt-4 col-md-6">
                <div class="room__card">
                <img src="image/longsejour4.jpg" alt="room" />
                    <div class="room__card__details">
                    <div class="room__content2">
                            <h4 >Suite Familiale </h4>
                             </div>
                             <div class="room__content2 "> 
                            <p> Composé de plusieurs pièces et d'un espace de vie commun.</p>
                            </div>
                            <div class="room__content">
                        <h3 class= "colonne" >$299/nuits</h3>
                        </div>
                        <div class = "room__content" >
                        <a href="reservation_offre.php" class="btn btn-primary">Réserver</a>
                        </div>
                    </div>
                </div>
            </div>


    

        </div>
    </div>
    </div>



    <?php include 'includes/footer.php'; ?>
      
</body>
</html>

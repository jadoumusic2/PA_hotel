              
            <?php 
            session_start();
            if(isset($_SESSION['email'])){
               include 'includes/db.php'; 
              
    $sql = "SELECT * FROM messages ORDER BY id DESC";
    $result = $conn->query($sql);

    if($result->num_rows == 0) {
        
        echo "Messagerie vide";
    } else {
       
        while($row = $result->fetch_assoc()) {
            
            if($row['email'] == $_SESSION['email']) {
                ?>
                <div class="message your_message">
                    <span>Vous</span>
                    <p><?= $row['msg'] ?></p>
                    <p class="date"><?= $row['date'] ?></p>
                </div>
                <?php
            } else {
                
                ?>
                <div class="message others_message">
                    <span><?= $row['email'] ?></span>
                    <p><?= $row['msg'] ?></p>
                    <p class="date"><?= $row['date'] ?></p>
                </div>
                <?php
            }
        } 
    }
}
?>

              
              
              
              
             
               
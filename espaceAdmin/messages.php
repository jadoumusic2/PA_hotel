
<style>
        .centre {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        form {
            margin: 10px;
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

    include '../includes/db.php'; 

    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
        $delete_id = $_POST['delete_id'];

        $sql = $conn->prepare("DELETE FROM messages WHERE id=?");
        $sql->bind_param("i", $delete_id); 
        if ($sql->execute()) {
            echo "<div class='success'>Message supprimé avec succès.</div>";
            header("Location: chat.php");
        } else {
            echo "<div class='error'>Erreur lors de la suppression : " . $conn->error . "</div>";
        }
    }

    
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
                    <form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
                        <input type='hidden' name='delete_id' value='<?= $row["id"] ?>'>
                        <input type='submit' name='delete' value='Supprimer'>
                    </form>
                </div>
                <?php
            } else {
                
                ?>
                <div class="message others_message">
                    <span><?= $row['email'] ?></span>
                    <p><?= $row['msg'] ?></p>
                    <p class="date"><?= $row['date'] ?></p>
                    <form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
                        <input type='hidden' name='delete_id' value='<?= $row["id"] ?>'>
                        <input type='submit' name='delete' value='Supprimer'>
                    </form>
                </div>
                <?php
            }
        } 
    }
?>

</body>
</html>

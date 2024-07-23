<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Admin - Afficher les membres</title>
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
            margin : 10px;
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

if (isset($_SESSION['role'])) {
    $user_role = $_SESSION['role'];
} else {
    header("Location: connexion.php");
    exit();
}

$user_email = $_SESSION['email'];

include 'header_admin.php';
include '../includes/db.php';

$search_result = [];


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $search_term = $_POST['search_term'];

    
    $sql = "SELECT id, nom, prenom, telephone, email, role, banni FROM utilisateurs WHERE nom LIKE '%$search_term%'";
    $result = $conn->query($sql);

    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $search_result[] = $row;
        }
    }
}

?>

<div class="centre">

<br>
<?php   echo "Email de l'admin connecté: " . $user_email; ?> <br><br> <?php
        echo "Role: " . $user_role; ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="search_term" placeholder="Rechercher par nom">
        <input type="submit" name="search" value="Rechercher">
    </form>

    <?php
    
    if (!empty($search_result)) {
        echo "<table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Banni</th>
                <th>PDF</th>
                <th>Action</th>
                <th>Bannir</th> 
                <th>Membre/Admin</th>
            </tr>";

        foreach ($search_result as $row) {
            echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row['nom']."</td>
                <td>".$row['prenom']."</td>
                <td>".$row['telephone']."</td>
                <td>".$row['email']."</td>
                <td>".($row['role'] == 1 ? 'Admin' : ($row['role'] == 2 ? 'Super Admin' : 'Membre'))."</td>
                <td>".($row['banni'] == 1 ? 'Oui' : 'Non')."</td>
                <td>
                <form method='post' action='generate_pdf.php'>
                        <input type='hidden' name='user_id' value='".$row["id"]."'>
                        <input type='submit' name='download_pdf' value='Télécharger PDF'>
                    </form>
                </td>
                <td>
                    <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                        <input type='hidden' name='delete_id' value='".$row["id"]."'>
                        <input type='submit' name='delete' value='Supprimer'>
                    </form>
                    <form method='post' action='membre_recup.php'>
                        <input type='hidden' name='modify_id' value='".$row["id"]."'>
                        <input type='submit' name='modify' value='Modifier'>
                    </form>
                </td>
                <td>
                    <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                        <input type='hidden' name='ban_email' value='".$row["email"]."'>
                        <input type='submit' name='ban' value='Bannir'>
                    </form>
                    <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                        <input type='hidden' name='unban_email' value='".$row["email"]."'>
                        <input type='submit' name='unban' value='Débannir'>
                    </form>
                </td>
                <td>
                    <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                        <input type='hidden' name='admin' value='".$row["email"]."'>
                        <input type='submit' name='admin_action' value='Admin'>
                    </form>
                    <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                        <input type='hidden' name='membre' value='".$row["email"]."'>
                        <input type='submit' name='membre_action' value='Membre'>
                    </form>
                </td>
            </tr>";
        }

        echo "</table>";
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
        
        echo "<div class='error'>Aucun résultat trouvé pour la recherche : " . htmlspecialchars($search_term) . "</div>";
    } else {
        
       
    }
    


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];

    
    $sql_get_email = $conn->prepare("SELECT email FROM utilisateurs WHERE id=?");
    $sql_get_email->bind_param("i", $delete_id);
    $sql_get_email->execute();
    $result_get_email = $sql_get_email->get_result();
    $row_get_email = $result_get_email->fetch_assoc();
    $delete_user_email = $row_get_email['email'];

    
    if ($user_role == 2) {
        
        $sql_get_superadmin_email = $conn->prepare("SELECT email FROM utilisateurs WHERE role=2");
        $sql_get_superadmin_email->execute();
        $result_get_superadmin_email = $sql_get_superadmin_email->get_result();
        $row_get_superadmin_email = $result_get_superadmin_email->fetch_assoc();
        $superadmin_email = $row_get_superadmin_email['email'];

        
        if ($delete_user_email != $superadmin_email) {
            
            $sql_delete = $conn->prepare("DELETE FROM utilisateurs WHERE id=?");
            $sql_delete->bind_param("i", $delete_id);
            if ($sql_delete->execute()) {
                echo "<div class='success'>Membre supprimé avec succès.</div>";
            } else {
                echo "<div class='error'>Erreur lors de la suppression : " . $conn->error . "</div>";
            }
        } else {
            
            echo "<div class='error'>Vous ne pouvez pas vous supprimer vous-même.</div>";
        }
    } elseif ($user_role == 1) {
        
        $sql_check_user_role = $conn->prepare("SELECT role FROM utilisateurs WHERE id=?");
        $sql_check_user_role->bind_param("i", $delete_id);
        $sql_check_user_role->execute();
        $result_check_user_role = $sql_check_user_role->get_result();
        $row_check_user_role = $result_check_user_role->fetch_assoc();
        if ($row_check_user_role['role'] == 0) {
            
            $sql_delete = $conn->prepare("DELETE FROM utilisateurs WHERE id=?");
            $sql_delete->bind_param("i", $delete_id);
            if ($sql_delete->execute()) {
                echo "<div class='success'>Membre supprimé avec succès.</div>";
            } else {
                echo "<div class='error'>Erreur lors de la suppression : " . $conn->error . "</div>";
            }
        } else {
            
            echo "<div class='error'>Vous ne pouvez pas supprimer un autre administrateur.</div>";
        }
    }
}

        




if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ban'])) {
    $banned_email = $_POST['ban_email'];

    
    if ($user_role == 2) {
        
        $sql_ban = $conn->prepare("UPDATE utilisateurs SET banni=1 WHERE email=?");
        $sql_ban->bind_param("s", $banned_email); 
        if ($sql_ban->execute()) {
            echo "<div class='success'>Utilisateur banni avec succès.</div>";
        } else {
            echo "<div class='error'>Erreur lors du bannissement : " . $conn->error . "</div>";
        }
    } elseif ($user_role == 1) {
        
        $sql_check_admin = $conn->prepare("SELECT role FROM utilisateurs WHERE email=?");
        $sql_check_admin->bind_param("s", $banned_email); 
        $sql_check_admin->execute();
        $result_check_admin = $sql_check_admin->get_result();
        $row_check_admin = $result_check_admin->fetch_assoc();
        if ($row_check_admin['role'] == 0) {
            
            $sql_ban = $conn->prepare("UPDATE utilisateurs SET banni=1 WHERE email=?");
            $sql_ban->bind_param("s", $banned_email); 
            if ($sql_ban->execute()) {
                echo "<div class='success'>Utilisateur banni avec succès.</div>";
            } else {
                echo "<div class='error'>Erreur lors du bannissement : " . $conn->error . "</div>";
            }
        } else {
            
            echo "<div class='error'>Vous ne pouvez pas bannir un autre administrateur.</div>";
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['unban'])) {
    $unbanned_email = $_POST['unban_email'];

    $sql = $conn->prepare("UPDATE utilisateurs SET banni=0 WHERE email=?");
    $sql->bind_param("s", $unbanned_email); 
    if ($sql->execute()) {
        echo "<div class='success'>Utilisateur débanni avec succès.</div>";
    } else {
        echo "<div class='error'>Erreur lors du débannissement : " . $conn->error . "</div>";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST['admin_action']) || isset($_POST['membre_action']))) {
    $action = isset($_POST['admin_action']) ? 'admin_action' : 'membre_action';
    $user_email = $_POST[$action == 'admin_action' ? 'admin' : 'membre'];

    
    if ($user_role == 2) {
        
        $new_role = isset($_POST['admin_action']) ? 1 : 0;
        $sql_update_role = $conn->prepare("UPDATE utilisateurs SET role=? WHERE email=?");
        $sql_update_role->bind_param("is", $new_role, $user_email); 
        if ($sql_update_role->execute()) {
            echo "<div class='success'>Rôle de l'utilisateur mis à jour avec succès.</div>";
        } else {
            echo "<div class='error'>Erreur lors de la mise à jour du rôle : " . $conn->error . "</div>";
        }
    } elseif ($user_role == 1) {
        
        $sql_check_admin = $conn->prepare("SELECT role FROM utilisateurs WHERE email=?");
        $sql_check_admin->bind_param("s", $user_email); 
        $sql_check_admin->execute();
        $result_check_admin = $sql_check_admin->get_result();
        $row_check_admin = $result_check_admin->fetch_assoc();
        if ($row_check_admin['role'] == 0) {
            
            $new_role = isset($_POST['admin_action']) ? 1 : 0;
            $sql_update_role = $conn->prepare("UPDATE utilisateurs SET role=? WHERE email=?");
            $sql_update_role->bind_param("is", $new_role, $user_email); 
            if ($sql_update_role->execute()) {
                echo "<div class='success'>Rôle de l'utilisateur mis à jour avec succès.</div>";
            } else {
                echo "<div class='error'>Erreur lors de la mise à jour du rôle : " . $conn->error . "</div>";
            }
        } else {
            
            echo "<div class='error'>Vous ne pouvez pas modifier le rôle d'un autre administrateur.</div>";
        }
    }
}

?> 
    <p>Membres :</p>
    <div class="centre">
     
    <?php
        
        $sql = "SELECT id, nom, prenom, telephone, email, role, banni FROM utilisateurs";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Banni</th>
                    <th>PDF</th>
                    <th>Action</th>
                    <th>Bannir</th> 
                    <th>Membre/Admin</th>
                </tr>";
            
            while($row = $result->fetch_assoc()) { 
                echo "<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['nom']."</td>
                    <td>".$row['prenom']."</td>
                    <td>".$row['telephone']."</td>
                    <td>".$row['email']."</td>
                    <td>".($row['role'] == 1 ? 'Admin' : ($row['role'] == 2 ? 'Super Admin' : 'Membre'))."</td>
                    <td>".($row['banni'] == 1 ? 'Oui' : 'Non')."</td>
                    <td>
                        <form method='post' action='generate_pdf.php'>
                            <input type='hidden' name='user_id' value='".$row["id"]."'>
                            <input type='submit' name='download_pdf' value='Télécharger PDF'>
                        </form>
                    </td>
                    <td>
                        <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                            <input type='hidden' name='delete_id' value='".$row["id"]."'>
                            <input type='submit' name='delete' value='Supprimer'>
                        </form>
                        <form method='post' action='membre_recup.php'>
                            <input type='hidden' name='modify_id' value='".$row["id"]."'>
                            <input type='submit' name='modify' value='Modifier'>
                        </form>
                    </td>
                    <td>
                        <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                            <input type='hidden' name='ban_email' value='".$row["email"]."'>
                            <input type='submit' name='ban' value='Bannir'>
                        </form>
                        <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                            <input type='hidden' name='unban_email' value='".$row["email"]."'>
                            <input type='submit' name='unban' value='Débannir'>
                        </form>
                    </td>
                    <td>
                        <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                            <input type='hidden' name='admin' value='".$row["email"]."'>
                            <input type='submit' name='admin_action' value='Admin'>
                        </form>
                        <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                            <input type='hidden' name='membre' value='".$row["email"]."'>
                            <input type='submit' name='membre_action' value='Membre'>
                        </form>
                    </td>
                    
                </tr>";
            }
            echo "</table>";
        } else {
            echo "0 résultats";
        }
    ?>
    </div>
       
    <br>
    <button><a href="logout.php" style="color:red; text-decoration:none;">Déconnexion</a></button>

</body>
</html>



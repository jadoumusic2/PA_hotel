<?php
require_once '/var/www/html/TCPDF/TCPDF-main/tcpdf.php';
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['download_pdf'])) {
    $user_id = $_POST['user_id'];


    $sql = "SELECT nom, prenom, telephone, email, role, banni FROM utilisateurs WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();


    $pdf = new TCPDF();
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Admin');
    $pdf->SetTitle('Informations du Membre');
    $pdf->SetSubject('Détails du Membre');
    $pdf->SetKeywords('TCPDF, PDF, membre, informations');


    $pdf->AddPage();


    $html = '<h1>Informations du Membre</h1>
             <p><strong>Nom:</strong> ' . $user['nom'] . '</p>
             <p><strong>Prénom:</strong> ' . $user['prenom'] . '</p>
             <p><strong>Téléphone:</strong> ' . $user['telephone'] . '</p>
             <p><strong>Email:</strong> ' . $user['email'] . '</p>
             <p><strong>Rôle:</strong> ' . ($user['role'] == 1 ? 'Admin' : ($user['role'] == 2 ? 'Super Admin' : 'Membre')) . '</p>
             <p><strong>Banni:</strong> ' . ($user['banni'] == 1 ? 'Oui' : 'Non') . '</p>';

    $pdf->writeHTML($html, true, false, true, false, '');


    $pdf->Output('informations_membre.pdf', 'D');
}
?>
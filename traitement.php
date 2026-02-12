<?php
$fichier = "avis.txt";

if (!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['message'])) {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    $date = date("d/m/y H:i:s");

    $ligne = "<<$nom|$email|$date|$message>>\n";
    file_put_contents($fichier, $ligne, FILE_APPEND | LOCK_EX);
}

header("Location: index.php");
exit;


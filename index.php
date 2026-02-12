<?php
$fichier = "avis.txt";
$avis = [];
if (file_exists($fichier)) {
    $avis = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $avis = array_reverse($avis);
    $avis = array_slice($avis, 0, 5); 
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Livre d’or</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 700px;
            margin: 30px auto;
            background-color: #f9f9f9;
            padding: 20px;
        }
        h1 { text-align: center; color: #333; }
        form { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 8px rgba(0,0,0,0.1); margin-bottom: 30px; }
        input, textarea { width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #ccc; }
        button { padding: 10px 20px; background: #007BFF; color: #fff; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .avis { background: #fff; padding: 15px; border-radius: 8px; margin-bottom: 15px; box-shadow: 0 0 5px rgba(0,0,0,0.05); }
        .avis strong { color: #007BFF; }
        .avis em { color: #888; font-size: 0.9em; }
        .avis p { margin-top: 8px; line-height: 1.4; }
    </style>
</head>
<body>
    <h1>Livre d’or</h1>

    
    <form action="traitement.php" method="POST">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="email" name="email" placeholder="Email" required>
        <textarea name="message" placeholder="Votre avis" required></textarea>
        <button type="submit">Envoyer</button>
    </form>

    <h2>Derniers avis</h2>
    <?php if (!empty($avis)): ?>
        <?php foreach ($avis as $ligne): ?>
            <?php
            $parts = explode("|", trim($ligne));
            if (count($parts) === 4):
                list($nom, $email, $date, $message) = $parts;
            ?>
                <div class="avis">
                    <strong><?= htmlspecialchars($nom) ?> (<?= htmlspecialchars($email) ?>)</strong><br>
                    <em><?= htmlspecialchars($date) ?></em>
                    <p><?= htmlspecialchars($message) ?></p>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun avis pour le moment.</p>
    <?php endif; ?>
</body>
</html>

<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$lang = $_SESSION['language'];
$username = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($lang == 'fr') ? 'Tableau de bord' : 'Dashboard'; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1><?php echo ($lang == 'fr') ? 'Bienvenue' : 'Welcome'; ?>, <?php echo htmlspecialchars($username); ?>!</h1>
        <p><?php echo ($lang == 'fr') ? 'Vous êtes connecté.' : 'You are logged in.'; ?></p>
        <p><?php echo ($lang == 'fr') ? 'Votre langue préférée est' : 'Your preferred language is'; ?>: 
           <?php echo ($lang == 'fr') ? 'Français' : 'English'; ?></p>
        <a href="logout.php"><?php echo ($lang == 'fr') ? 'Se déconnecter' : 'Logout'; ?></a>
    </div>
</body>
</html>
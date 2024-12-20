<?php
session_start();


if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? $_POST['remember'] : '';
    $language = $_POST['language'];

    
    if ($username === 'user' && $password === 'password') {
        $_SESSION['user'] = $username;
        $_SESSION['language'] = $language;

        if ($remember == 'on') {
            setcookie("remember_user", $username, time() + (86400 * 30), "/"); 
        }

        setcookie("preferred_language", $language, time() + (86400 * 365), "/"); 

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Identifiants incorrects";
    }
}

$lang = isset($_COOKIE['preferred_language']) ? $_COOKIE['preferred_language'] : 'fr';
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($lang == 'fr') ? 'Connexion' : 'Login'; ?></title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <form method="POST">
            <h2><?php echo ($lang == 'fr') ? 'Connexion' : 'Login'; ?></h2>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            <div class="form-group">
                <label for="username"><?php echo ($lang == 'fr') ? 'Nom d\'utilisateur' : 'Username'; ?>:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password"><?php echo ($lang == 'fr') ? 'Mot de passe' : 'Password'; ?>:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div id="checkbox" class="form-group">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember"><?php echo ($lang == 'fr') ? 'Se souvenir de moi' : 'Remember me'; ?></label>
            </div>
            <div class="form-group">
                <label for="language"><?php echo ($lang == 'fr') ? 'Langue' : 'Language'; ?>:</label>
                <select id="language" name="language">
                    <option value="fr" <?php echo ($lang == 'fr') ? 'selected' : ''; ?>>Français</option>
                    <option value="en" <?php echo ($lang == 'en') ? 'selected' : ''; ?>>English</option>
                </select>
            </div>
            <button type="submit"><?php echo ($lang == 'fr') ? 'Se connecter' : 'Login'; ?></button>
        </form>
    </div>
</body>
</html>
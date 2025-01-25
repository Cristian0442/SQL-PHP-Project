<?php
session_start(); // Start the session

// Verificăm dacă utilizatorul este deja autentificat
if (isset($_SESSION['username'])) {
    header('Location: sesiune_filme.php'); // Redirect to the main page
    exit();
}

// Definirea userului și parolei corecte
$correct_username = 'cristian';
$correct_password = '1234';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificăm dacă datele de autentificare sunt corecte
    if ($username === $correct_username && $password === $correct_password) {
        $_SESSION['username'] = $username; // Stocăm numele de utilizator în sesiune
        header('Location: sesiune_filme.php'); // Redirect to the main page
        exit();
    } else {
        $error_message = 'Username sau parolă incorectă!';
    }
}
?>

<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logare</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="login-container">
        <h1>Logare</h1>

        <?php
        // Afișăm mesajul de eroare dacă există
        if (isset($error_message)) {
            echo '<p class="error-message">' . $error_message . '</p>';
        }
        ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Parolă</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Autentificare</button>
            </div>
        </form>
    </div>

    <footer class="footer">&copy; 2025 Filme DB</footer>
</body>
</html>

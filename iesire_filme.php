<?php
session_start();
// se verifică dacă utilizatorul curent a efectuat "log in"
$ut_prec = $_SESSION['username'];
unset($_SESSION['username']);
session_destroy();
?>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iesire din cont</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Iesire</h1>
    </header>

    <main>
        <?php
        if (!empty($ut_prec)) {
            echo 'La revedere...<br />';
        } else {
            // Dacă s-a ajuns din greșeală la această pagină fără a fi efectuat logare
            echo 'Nu ati efectuat log in, nu aveti cum efectua log out.<br />';
        }
        ?>
        
        <a href="functie.php" class="revenire">Revenire la pagina principala</a>
    </main>

    <footer>&copy; 2025 Filme DB</footer>
</body>
</html>

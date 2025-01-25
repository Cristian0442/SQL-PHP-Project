<?php
session_start(); // Start the session

// Verificăm dacă utilizatorul este autentificat
if (!isset($_SESSION['username'])) {
    header('Location: functie.php'); // Dacă nu este autentificat, redirecționăm la logare
    exit();
}

// Adresa utilizatorului autentificat
$username = $_SESSION['username'];

// Închidere sesiune (delogare)
if (isset($_GET['logout'])) {
    session_destroy();  // Distruge sesiunea
    header('Location: functie.php'); // Redirecționează la pagina de logare
    exit();
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina principală Filme DB</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Antetul paginii -->
    <header>
        <h1>Bine ai venit, <?php echo htmlspecialchars($username); ?>!</h1>
        <p>Te rugăm să selectezi o opțiune din meniul de mai jos:</p>
        <!-- Link de logare -->
        <a href="?logout=true" class="button logout-btn">Delogare</a>
    </header>

    <!-- Meniul de navigare -->
    <nav>
        <div class="menu-container">
            <!-- Meniul interactiv cu opțiunile -->
            <div class="menu-item">
                <a href="interfata_rezultate_filme.html" class="menu-link">Vezi filmele de un anumit gen</a>
            </div>

            <div class="menu-item">
                <a href="init_nume.php" class="menu-link">Vezi actorii avand numele cu litera P</a>
            </div>

            <div class="menu-item">
                <a href="interogare_Toby.php" class="menu-link">Vezi filmele legate de Toby Stephens</a>
            </div>

            <div class="menu-item">
                <a href="perechi_actori.php" class="menu-link">Vezi perechile de actori de sex opus</a>
            </div>

            <div class="menu-item">
                <a href="nume_presedinte_castig_maxim.php" class="menu-link">Vezi presedintele cu cel mai mare castig</a>
            </div>

            <div class="menu-item">
                <a href="filme_vechi_Die.php" class="menu-link">Vezi filmele cu o durata mai scurta decat a filmului "Die Another Day"</a>
            </div>

            <div class="menu-item">
                <a href="gen_copii.php" class="menu-link">Vezi in cate filme de genul "copii" a jucat fiecare actor</a>
            </div>

            <div class="menu-item">
                <a href="castiguri.php" class="menu-link">Vezi castigurile actorilor simpli</a>
            </div>

            <div class="menu-item">
                <a href="procedura_stocata.php" class="menu-link">Verificare procedura stocata</a>
            </div>
        </div>
    </nav>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Filme DB</p>
    </footer>

</body>
</html>

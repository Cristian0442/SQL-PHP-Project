<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logare cont</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Lista cu filme</h1>
    </header>

    <?php
    // Creare variabile scurte
    $gen_f = $_POST['gen'] ?? '';
    $gen_f = trim($gen_f);

    if (!$gen_f) {
        echo 'Nu ati introdus criteriul de cautare. ';
        echo '<a href="interfata_rezultate_filme.html" class="revenire">Incercati o noua cautare</a>';
        exit;
    }

    $user = 'scoala';
    $pass = 'scoala';
    $host = 'localhost';
    $db_name = 'filme';

    // Conectare la baza de date
    $connect = mysqli_connect($host, $user, $pass, $db_name);

    // Verificare conexiune
    if (!$connect) {
        die('Eroare la conectare: ' . mysqli_connect_error());
    }

    // Interogare pregătită
    $query = "SELECT * FROM Film WHERE gen = ? ORDER BY an ASC, titlu DESC";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "s", $gen_f);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die('Interogare gresita: ' . mysqli_error($connect));
    }

    // Obține numărul de rezultate
    $num_results = mysqli_num_rows($result);

    if ($num_results > 0) {
        echo '<table class="styled-table">
            <thead>
                <tr>
                    <th>Titlu</th>
                    <th>An</th>
                    <th>Durata</th>
                    <th>Gen</th>
                    <th>Studio</th>
                    <th>Id_producator</th>
                </tr>
            </thead>
            <tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars(stripslashes($row['titlu'])) . '</td>';
            echo '<td>' . htmlspecialchars(stripslashes($row['an'])) . '</td>';
            echo '<td>' . htmlspecialchars(stripslashes($row['durata'])) . '</td>';
            echo '<td>' . htmlspecialchars(stripslashes($row['gen'])) . '</td>';
            echo '<td>' . htmlspecialchars(stripslashes($row['studio'])) . '</td>';
            echo '<td>' . htmlspecialchars(stripslashes($row['id_producator'])) . '</td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
    } else {
        echo 'Nu s-au găsit rezultate pentru criteriul selectat. ';
    }

    echo '<a href="interfata_rezultate_filme.html" class="revenire">Incercati o noua cautare</a>';

    // Închidere conexiune
    mysqli_close($connect);
    ?>

    <a href="sesiune_filme.php" class="revenire">Revenire la pagina principala</a>

    <footer>&copy; 2025 Filme DB</footer>
</body>
</html>

<html>
<head>
    <link rel="stylesheet" href="style.css"> <!-- Legătura către fișierul CSS -->
</head>
<body>
    <header>
        <h1>Actorii care au jucat in filme de genul "copii"</h1>
        <p>Lista actorilor și numărul de filme în care au jucat</p>
    </header>
    
    <?php
    $user = 'scoala';
    $pass = 'scoala';
    $host = 'localhost';
    $db_name = 'filme';

    // Conectare la baza de date
    $connect = mysqli_connect($host, $user, $pass, $db_name);

    if (!$connect) {
        die('<p style="color:red; text-align:center;">Eroare la conectare: ' . mysqli_connect_error() . '</p>');
    }

    // Interogare pentru perechi de actori
    $query = "SELECT d.id_actor, COUNT(*) AS numar_filme
              FROM Distributie d
              JOIN Film f ON d.titlu_film = f.titlu AND d.an_film = f.an
              WHERE f.gen = 'copii'
              GROUP BY d.id_actor";

    $result = mysqli_query($connect, $query);

    if (!$result) {
        die('<p style="color:red; text-align:center;">Interogare greșită: ' . mysqli_error($connect) . '</p>');
    }

    $num_results = mysqli_num_rows($result);

    if ($num_results > 0) {
        echo '<table>
                <tr>
                    <th>Id Actor</th>
                    <th>Numar de filme</th>
                </tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['id_actor']) . '</td>';
            echo '<td>' . htmlspecialchars($row['numar_filme']) . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p style="text-align:center; color:red;">Nu există rezultate pentru această interogare.</p>';
    }

    mysqli_close($connect);
    ?>

    <a href="sesiune_filme.php" class="revenire">Revenire la pagina principală</a> <!-- Butonul de revenire -->

    <footer>&copy; 2025 Filme DB</footer>
</body>
</html>

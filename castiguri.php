<html>
<head>
    <link rel="stylesheet" href="style.css"> <!-- Legătura către fișierul CSS -->
</head>
<body>
    <header>
        <h1>Castigurile inregistrate</h1>
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

    // Interogare pentru castigurile inregistrate
    $query = "SELECT ROUND(MIN(castig_net),2) AS castig_minim, ROUND(AVG(castig_net),2) AS castig_mediu, ROUND(MAX(castig_net),2) AS castig_maxim
    FROM Persoana p WHERE p.id_persoana NOT IN (SELECT id_producator FROM Film UNION SELECT id_presedinte FROM Studio)";

    $result = mysqli_query($connect, $query);

    if (!$result) {
        die('<p style="color:red; text-align:center;">Interogare greșită: ' . mysqli_error($connect) . '</p>');
    }

    $num_results = mysqli_num_rows($result);

    if ($num_results > 0) {
        echo '<table>
            <tr>
                <th>Castig Minim</th>
                <th>Castig Mediu</th>
                <th>Castig Maxim</th>
            </tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['castig_minim']) . '</td>';
            echo '<td>' . htmlspecialchars($row['castig_mediu']) . '</td>';
            echo '<td>' . htmlspecialchars($row['castig_maxim']) . '</td>';
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

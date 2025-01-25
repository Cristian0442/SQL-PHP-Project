<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmele cu durata mai mică decât a filmului "Die Another Day"</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Filmele cu durata mai mică decât a filmului "Die Another Day"</h1>
        <p>Acestea sunt filmele care au o durată mai mică decât filmul "Die Another Day" (2002).</p>
    </header>

    <main>
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

        // Interogare pentru a selecta filmele cu durata mai mică decât "Die Another Day"
        $query = "SELECT titlu, an, durata FROM Film WHERE durata < (
            SELECT durata FROM Film WHERE titlu = 'Die Another Day' AND an = 2002)";

        $result = mysqli_query($connect, $query);

        if (!$result) {
            die('<p style="color:red; text-align:center;">Interogare greșită: ' . mysqli_error($connect) . '</p>');
        }

        $num_results = mysqli_num_rows($result);

        if ($num_results > 0) {
            echo '<table>
                <tr>
                    <th>Titlu</th>
                    <th>An</th>
                    <th>Durata</th>
                </tr>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['titlu']) . '</td>';
                echo '<td>' . htmlspecialchars($row['an']) . '</td>';
                echo '<td>' . htmlspecialchars($row['durata']) . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p style="text-align:center; color:red;">Nu există rezultate pentru această interogare.</p>';
        }

        mysqli_close($connect);
        ?>
    </main>

    <a href="sesiune_filme.php" class="revenire">Revenire la pagina principală</a>

    <footer>&copy; 2025 Filme DB</footer>
</body>
</html>

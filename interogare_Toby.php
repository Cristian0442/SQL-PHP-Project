<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmele în care actorul Toby Stephens a fost și actor, și producător</title>
    <!-- Legătura către fișierul CSS extern -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Filmele în care actorul Toby Stephens a fost și actor, și producător</h1>
        <p>Te rugăm să consulți lista de mai jos cu filmele în care Toby Stephens a jucat și a produs.</p>
    </header>

    <main>
        <?php
        $user = 'scoala';
        $pass = 'scoala';
        $host = 'localhost';
        $db_name = 'filme';

        $connect = mysqli_connect($host, $user, $pass, $db_name);

        if ($connect->connect_error) {
            die('<p style="color:red; text-align:center;">Eroare la conectare: ' . $connect->connect_error . '</p>');
        }

        $query = "SELECT f.* FROM Film f 
                  JOIN Distributie d ON f.titlu = d.titlu_film AND f.an = d.an_film 
                  JOIN Persoana p ON p.id_persoana = d.id_actor AND p.nume = 'Toby Stephens'
                  WHERE f.id_producator = d.id_actor";

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
                    <th>Gen</th>
                    <th>Studio</th>
                    <th>Id_producator</th>
                </tr>';

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

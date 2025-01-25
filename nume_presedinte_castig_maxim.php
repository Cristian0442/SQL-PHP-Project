<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numele președintelui de studio cu cel mai mare câștig net</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Numele președintelui de studio cu cel mai mare câștig net</h1>
        <p>Aflați cine este președintele de studio cu cel mai mare câștig net.</p>
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

        // Interogare pentru a găsi președintele de studio cu cel mai mare câștig net
        $query = "SELECT p.nume
        FROM Persoana p
        JOIN Studio s ON p.id_persoana = s.id_presedinte
        WHERE p.castig_net = (
            SELECT MAX(castig_net)
            FROM Persoana)";

        $result = mysqli_query($connect, $query);

        if (!$result) {
            die('<p style="color:red; text-align:center;">Interogare greșită: ' . mysqli_error($connect) . '</p>');
        }

        $num_results = mysqli_num_rows($result);

        if ($num_results > 0) {
            echo '<table>
                <tr>
                    <th>Nume</th>
                </tr>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['nume']) . '</td>';
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

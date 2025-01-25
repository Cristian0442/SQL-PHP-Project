<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persoanele ale căror nume încep cu litera 'P'</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Persoanele ale căror nume încep cu litera 'P'</h1>
    </header>

    <main>
        <?php
        $user = 'scoala';
        $pass = 'scoala';
        $host = 'localhost';
        $db_name = 'filme';

        // Conectare la baza de date
        $connect = mysqli_connect($host, $user, $pass, $db_name);

        if ($connect->connect_error) {
            die('<p style="color:red; text-align:center;">Eroare la conectare: ' . $connect->connect_error . '</p>');
        }

        // Interogare pentru persoane ale căror nume încep cu 'P' și email-ul conține 'com'
        $query = "SELECT nume, adresa, email, sex, data_nasterii FROM Persoana
                  WHERE nume LIKE 'P%' AND email LIKE '%com%'
                  ORDER BY nume ASC";
        $result = mysqli_query($connect, $query);

        if (!$result) {
            die('<p style="color:red; text-align:center;">Interogare greșită: ' . mysqli_error($connect) . '</p>');
        }

        $num_results = mysqli_num_rows($result);

        if ($num_results > 0) {
            echo '<table>
                <tr>
                    <th>Nume</th>
                    <th>Adresă</th>
                    <th>Email</th>
                    <th>Sex</th>
                    <th>Data nașterii</th>
                </tr>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars(stripslashes($row['nume'])) . '</td>';
                echo '<td>' . htmlspecialchars(stripslashes($row['adresa'])) . '</td>';
                echo '<td>' . htmlspecialchars(stripslashes($row['email'])) . '</td>';
                echo '<td>' . htmlspecialchars(stripslashes($row['sex'])) . '</td>';
                echo '<td>' . htmlspecialchars(stripslashes($row['data_nasterii'])) . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p style="text-align:center; color:red;">Nu există rezultate pentru această interogare.</p>';
        }

        // Închidere conexiune
        mysqli_close($connect);
        ?>
        
        <!-- Link pentru revenire -->
        <a href="sesiune_filme.php" class="revenire">Revenire la pagina principală</a>
    </main>

    <footer>&copy; 2025 Filme DB</footer>
</body>
</html>

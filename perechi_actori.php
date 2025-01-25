<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perechile de actori de sex diferit care au jucat în același film</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Perechile de actori de sex diferit care au jucat în același film</h1>
        <p>Lista perechilor de actori de sex diferit care au jucat în aceleași filme.</p>
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

        // Interogare pentru perechi de actori
        $query = "SELECT DISTINCT d1.id_actor AS id_actor1, d2.id_actor AS id_actor2 
                  FROM Distributie d1 
                  JOIN Distributie d2 ON d1.titlu_film = d2.titlu_film AND d1.an_film = d2.an_film
                  JOIN Persoana p1 ON d1.id_actor = p1.id_persoana 
                  JOIN Persoana p2 ON d2.id_actor = p2.id_persoana 
                  WHERE p1.sex != p2.sex AND d1.id_actor < d2.id_actor";

        $result = mysqli_query($connect, $query);

        if (!$result) {
            die('<p style="color:red; text-align:center;">Interogare greșită: ' . mysqli_error($connect) . '</p>');
        }

        $num_results = mysqli_num_rows($result);

        if ($num_results > 0) {
            echo '<table>
                <tr>
                    <th>Id Actor 1</th>
                    <th>Id Actor 2</th>
                </tr>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id_actor1']) . '</td>';
                echo '<td>' . htmlspecialchars($row['id_actor2']) . '</td>';
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

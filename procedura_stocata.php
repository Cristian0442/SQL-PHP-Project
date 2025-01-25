<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verificare Excepții</title>
    <link rel="stylesheet" href="style.css"> <!-- Legătura către fișierul CSS -->
</head>
<body>
    <header>
        <h1>Executare Procedură Stocată - Verificare Excepții</h1>
    </header>

    <?php
    // Detalii de conectare la baza de date
    $user = 'scoala';
    $pass = 'scoala';
    $host = 'localhost';
    $db_name = 'filme';

    // Conectare la baza de date
    $connect = mysqli_connect($host, $user, $pass, $db_name);

    // Verificare conexiune
    if (!$connect) {
        die('<p style="color:red; text-align:center;">Eroare la conectare: ' . mysqli_connect_error() . '</p>');
    }

    // Ștergerea procedurii stocate dacă există deja
    $query_drop_procedure = "DROP PROCEDURE IF EXISTS VerificaExcepții";

    if (!mysqli_query($connect, $query_drop_procedure)) {
        die('<p style="color:red; text-align:center;">Eroare la ștergerea procedurii: ' . mysqli_error($connect) . '</p>');
    }

    // Crearea procedurii stocate
    $query_create_procedure = "
    CREATE PROCEDURE VerificaExcepții()
    BEGIN
        DECLARE done INT DEFAULT 0;
        DECLARE p_id INT;
        DECLARE p_castig_net DECIMAL(10, 2);
        DECLARE p_studio VARCHAR(100);
        DECLARE cur CURSOR FOR 
            SELECT p.id_persoana, p.castig_net, s.nume 
            FROM Persoana p
            JOIN Studio s ON p.id_persoana = s.id_presedinte;

        DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

        OPEN cur;

        read_loop: LOOP
            FETCH cur INTO p_id, p_castig_net, p_studio;
            IF done THEN
                LEAVE read_loop;
            END IF;

            -- Verifică dacă există excepții
            INSERT IGNORE INTO Excepții (id_persoana, nume, adresa, email, sex, data_nasterii, castig_net, moneda, natura_exceptie)
            SELECT p.id_persoana, p.nume, p.adresa, p.email, p.sex, p.data_nasterii, p.castig_net, p.moneda, 
                   'Castig_net mai mic decat al unui actor/producator din acel studio'
            FROM Persoana p
            JOIN Distributie d ON p.id_persoana = d.id_actor
            JOIN Film f ON f.titlu = d.titlu_film
            WHERE f.studio = p_studio AND (p.castig_net < (SELECT MAX(castig_net) FROM Persoana WHERE id_persoana IN (SELECT id_persoana FROM Distributie WHERE titlu_film = f.titlu)));
        END LOOP;

        CLOSE cur;
    END;
    ";

    if (mysqli_query($connect, $query_create_procedure)) {
        echo '<p style="text-align:center; color:green;">Procedura stocată a fost creată cu succes!</p>';
    } else {
        echo '<p style="color:red; text-align:center;">Eroare la crearea procedurii stocate: ' . mysqli_error($connect) . '</p>';
    }

    // Apelăm procedura stocată
    $query_call_procedure = "CALL VerificaExcepții()";

    if (!mysqli_query($connect, $query_call_procedure)) {
        die('<p style="color:red; text-align:center;">Eroare la apelul procedurii: ' . mysqli_error($connect) . '</p>');
    } else {
        echo '<p style="text-align:center; color:green;">Procedura a fost executată cu succes!</p>';
    }

    // Închidem conexiunea la baza de date
    mysqli_close($connect);
    ?>

    <nav>
        <a href="sesiune_filme.php" class="revenire">Revenire la pagina principală</a> <!-- Butonul de revenire -->
    </nav>

    <footer>&copy; 2025 Filme DB</footer>
</body>
</html>

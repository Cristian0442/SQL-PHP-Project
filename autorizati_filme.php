//autorizati_filme.php
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9f5e9;
        }

        td {
            border-bottom: 1px solid #ddd;
        }

        a {
            display: block;
            text-align: center;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            width: 200px;
        }

        a:hover {
            background-color: #45a049;
        }

        footer {
            text-align: center;
            margin: 20px 0;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<?php
session_start();
echo '<h1>Bine ai venit!</h1>';
// se verifică variabila de sesiune
if (isset($_SESSION['utilizator']))
{
 echo '<p>Sunteti intrat cu numele '.$_SESSION['utilizator'].'</p>';
 echo '<p>Pentru aceste date detineti drepturi</p>';
}
else
{
 echo '<p>Nu ati efectuat log in.</p>';
 echo '<p>Acces restrictionat.</p>';
}
echo '<a href="sesiune_filme.php">Revenire la pagina principala</a>';
?>
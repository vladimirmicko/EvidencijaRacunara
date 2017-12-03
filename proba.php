<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Hello</h1>
        <table border="1">
            <tr>
                <td>ID</td>
                <td>Autor</td>
                <td>Naslov</td>
                <td>Izdavac</td>
                <td>Godina</td>
                <td></td>
                <td></td>
            </tr>
<?php

// Povezivanje sa serverom baze podataka
$bp = mysqli_connect("localhost", "root", "root", "evidencija_racunara");
if (!$bp)
   die("Greska pri pristupu bazi podataka.");

//// Ucitavanje svih autora
//$users = array();
//$rezultat = mysqli_query($bp, "select * from korisnici");
//if (!$rezultat)
//    die(mysqli_error($bp));
//while ($row = mysqli_fetch_object($rezultat))
//    $users[$korisnici->ID] = $row;

// Ucitavanje podataka iz baze
$rezultat = mysqli_query($bp, "select * from korisnici");
if (!$rezultat)
    die(mysqli_error($bp));

// Izlistavanje opcija
while ($row = mysqli_fetch_object($rezultat))
{
    echo "<tr>\n";
    echo "<td>{$row->id}</td>\n";
    echo "<td>{$row->ime}</td>\n";
    echo "<td>{$row->prezime}</td>\n";
    echo "<td>hhhhhhhhhhhh</td>\n";
    echo "<td><a href='izmena-knjige.php?ID={$row->id}'>Izmena</a></td>\n";
    echo "<td><a href='uklanjanje-knjige.php?ID={$row->id}'>Uklanjanje</a></td>\n";
    echo "</tr>\n";
}
?>
        </table>
        
        <a href="dodavanje-knjige.php">Dodavanje knjige</a>
        <a href="dodavanje-autora.php">Dodavanje autora</a>
    </body>
</html>

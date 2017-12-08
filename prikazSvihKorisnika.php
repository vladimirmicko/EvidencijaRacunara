<?php

$bp = mysqli_connect("localhost", "root", "root", "evidencija_racunara");
if (!$bp)
   die("Greska pri pristupu bazi podataka.");


$upit = "select * from korisnici;";
$rezultat = mysqli_query($bp, $upit);
if (!$rezultat)
    die(mysqli_error($bp));

$rows = mysqli_fetch_all($rezultat, MYSQLI_ASSOC);
$myJSON = json_encode($rows);
echo $myJSON;
?>
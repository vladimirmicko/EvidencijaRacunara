<?php

$bp = mysqli_connect("localhost", "root", "root", "evidencija_racunara");
if (!$bp)
   die("Greska pri pristupu bazi podataka.");

$id = (int) @$_GET['id'];

$upit = "delete from korisnici where id=$id;";
$rezultat = mysqli_query($bp, $upit);
if (!$rezultat)
    die(mysqli_error($bp));

header("Location: korisnici.php");
?>
<?php

$bp = mysqli_connect("localhost", "root", "root", "evidencija_racunara");
if (!$bp)
   die("Greska pri pristupu bazi podataka.");

$proizvodjac = mysqli_real_escape_string($bp, @$_POST['proizvodjac']);
$model = mysqli_real_escape_string($bp, @$_POST['model']);

$korisnik_id=62;
$upit = "insert into racunari (proizvodjac, model, korisnik_id) values ('$proizvodjac','$model','$korisnik_id');";
$rezultat = mysqli_query($bp, $upit);
if (!$rezultat)
    die(mysqli_error($bp));

header("Location: racunari.php");
<?php

// Povezivanje sa serverom baze podataka
$bp = mysqli_connect("localhost", "root", "root", "evidencija_racunara");
if (!$bp)
   die("Greska pri pristupu bazi podataka.");

// Normalizacaija podataka
$ime = mysqli_real_escape_string($bp, @$_POST['ime']);
$prezime = mysqli_real_escape_string($bp, @$_POST['prezime']);
$odeljenje = mysqli_real_escape_string($bp, @$_POST['odeljenje']);

// Upis u bazu
$upit = "insert into korisnici (ime, prezime, odeljenje) values ('$ime','$prezime','$odeljenje');";
$rezultat = mysqli_query($bp, $upit);
if (!$rezultat)
    die(mysqli_error($bp));

// Preusmeravanje nazad na pregled
header("Location: korisnici.php");
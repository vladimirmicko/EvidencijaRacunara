<?php

// Povezivanje sa serverom baze podataka
$bp = mysqli_connect("localhost", "root", "root", "evidencija_racunara");
if (!$bp)
   die("Greska pri pristupu bazi podataka.");

// Normalizacaija podataka
$id = mysqli_real_escape_string($bp, @$_POST['korisnik_id']);
$ime = mysqli_real_escape_string($bp, @$_POST['ime']);
$prezime = mysqli_real_escape_string($bp, @$_POST['prezime']);
$odeljenje = mysqli_real_escape_string($bp, @$_POST['odeljenje']);

// Upis u bazu
$upit = "update korisnici set ime='$ime', prezime='$prezime', odeljenje='$odeljenje' where id=$id;";
$rezultat = mysqli_query($bp, $upit);
if (!$rezultat)
    die(mysqli_error($bp));

// Preusmeravanje nazad na pregled
header("Location: korisnici.php");
<?php

$bp = mysqli_connect("localhost", "root", "root", "evidencija_racunara");
if (!$bp)
   die("Greska pri pristupu bazi podataka.");

$id = mysqli_real_escape_string($bp, @$_POST['racunar_id']);
$proizvodjac = mysqli_real_escape_string($bp, @$_POST['izmenaProizvodjaca']);
$model = mysqli_real_escape_string($bp, @$_POST['izmenaModela']);
$izmenaKorisnika = mysqli_real_escape_string($bp, @$_POST['izmenaKorisnika']);

$upit = "update racunari set proizvodjac='$proizvodjac', model='$model', korisnik_id='$izmenaKorisnika' where id=$id;";
$rezultat = mysqli_query($bp, $upit);
if (!$rezultat)
    die(mysqli_error($bp));

header("Location: racunari.php");
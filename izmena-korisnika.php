<?php

$bp = mysqli_connect("localhost", "root", "root", "evidencija_racunara");
if (!$bp)
   die("Greska pri pristupu bazi podataka.");

$id = mysqli_real_escape_string($bp, @$_POST['korisnik_id']);
$ime = mysqli_real_escape_string($bp, @$_POST['izmenaImena']);
$prezime = mysqli_real_escape_string($bp, @$_POST['izmenaPrezimena']);
$odeljenje = mysqli_real_escape_string($bp, @$_POST['izmenaOdeljenja']);

$upit = "update korisnici set ime='$ime', prezime='$prezime', odeljenje='$odeljenje' where id=$id;";
$rezultat = mysqli_query($bp, $upit);
if (!$rezultat)
    die(mysqli_error($bp));

header("Location: korisnici.php");
<?php

$kid = $_REQUEST["id"];

$bp = mysqli_connect("localhost", "root", "root", "evidencija_racunara");
if (!$bp)
    die("Greska pri pristupu bazi podataka.");

$rezultat = mysqli_query($bp, "select * from korisnici left join racunari on racunari.korisnik_id=korisnici.id where korisnici.id=$kid");
if (!$rezultat)
    die(mysqli_error($bp));

$json = mysqli_fetch_all($rezultat, MYSQLI_ASSOC);
echo json_encode($json);
?>
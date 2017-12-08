<?php
// get the q parameter from URL
$id = $_REQUEST["id"];

$bp = mysqli_connect("localhost", "root", "root", "evidencija_racunara");
if (!$bp)
   die("Greska pri pristupu bazi podataka.");


$upit = "select * from racunari where id=$id;";
$rezultat = mysqli_query($bp, $upit);
if (!$rezultat)
    die(mysqli_error($bp));

$row = mysqli_fetch_object($rezultat);
$myJSON = json_encode($row);
echo $myJSON;

?>
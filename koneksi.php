<?php
$host       = "localhost:3307";
$user       = "root";
$pass       = "";
$db         = "db_ikke";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { 
    die("Tidak bisa terkoneksi ke database");
}

?>
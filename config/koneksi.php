<?php

// definisikan koneksi ke database
//$server = "192.168.3.43";
//$username = "goslog";
//$password = "itgos";
//$database = "goslog_dev";

$server = "localhost";
$username = "goslog";
$password = "itgoslog12";
$database = "goslog";

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");

?>

<?php
session_start();
include 'config/koneksi.php';
$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['pass']);
$password = md5($password);
// query untuk mendapatkan record dari username
$query = "SELECT * FROM user WHERE username = '$username'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
// cek kesesuaian password
if ($password == $data['password'])
{
	session_start();
  // menyimpan username dan level ke dalam session
    $_SESSION['username1'] = $data['username'];
    $_SESSION['level'] = $data['level'];
		if($_SESSION['level']==1){
		header('location:media.php');
		} else if($_SESSION['level']==2){
		header('location:media.php');
		}	
    //Penggunaan Meta Header HTTP
	exit;
}
else {
echo "<script type='text/javascript'> alert('Gagal Login, username/password tidak sesuai'); document.location='index.php' </script>";
}
?>
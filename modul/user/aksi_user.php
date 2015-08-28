<?php 
include "../../config/koneksi.php";
include "../../config/class_paging.php";
	@session_start();
	error_reporting(0);
	if(isset($_SESSION['username1']))
	{
		$q = mysql_query("select nama_user from user where username='".$_SESSION['username1']."'");
		while($hasil = mysql_fetch_array($q)){
		   $nama = $hasil['nama_user'];	
		   }
		   }

$module=$_GET['module'];
$act=$_GET['act'];

if($module=='user' AND $act=='input' ){
$cekdata="select * from user where username='$_POST[username]'"; 
$ada=mysql_query($cekdata) or die(mysql_error()); 
if(mysql_num_rows($ada)>0) { 
echo "<script type='text/javascript'> alert('Username sudah ada, silakan ulangi kembali'); document.location='../../media.php?module=user&act=input' </script>";
} else { 
if ($_POST['password2']==$_POST['password']) {
$password = $_POST['password'];
$password = md5($password);
$query = mysql_query("insert into user set nama_user='$_POST[nama_user]', username='$_POST[username]', password='$password', level='$_POST[level]'");
	header('location:../../media.php?module='.$module);
} else {
echo "<script type='text/javascript'> alert('Password tidak sesuai, silakan ulangi kembali'); document.location='../../media.php?module=user&act=input' </script>";
}
}
}

elseif($module=='klien' AND $act=='edit') {
	mysql_query("update tbl_klien set nama_klien='$_POST[nama_klien]', updated_by='$nama', updated=(select current_timestamp) where id_klien='$_POST[id_klien]'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='klien' AND $act=='hapus' ){
	mysql_query("delete from tbl_klien where id_klien='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}

?>

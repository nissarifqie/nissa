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

if($module=='klien' AND $act=='input' ){
	$query = mysql_query("insert into tbl_klien set id_klien='$_POST[id_klien]', nama_klien='$_POST[nama_klien]', created=(select current_timestamp), created_by='$nama', updated=(select current_timestamp), updated_by='$nama' ");
	header('location:../../media.php?module='.$module);
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

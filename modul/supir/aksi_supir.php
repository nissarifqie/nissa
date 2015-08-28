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


if($module=='supir' AND $act=='input' ){
	$query = mysql_query("insert into tbl_supir set nama_supir='$_POST[nama_supir]', no_telepon='$_POST[no_telepon]', created=(select current_timestamp), created_by='$nama', updated=(select current_timestamp), updated_by='$nama' ");
	header('location:../../media.php?module='.$module);
}

elseif($module=='supir' AND $act=='edit') {
	mysql_query("update tbl_supir set nama_supir='$_POST[nama_supir]', no_telepon='$_POST[no_telepon]', updated_by='$nama', updated=(select current_timestamp) where id_supir='$_POST[id_supir]'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='supir' AND $act=='hapus' ){
	mysql_query("delete from tbl_supir where id_supir='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}
?>
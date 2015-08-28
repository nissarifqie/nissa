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


if($module=='vendor' AND $act=='input' ){
	mysql_query("insert into vendor set  nama_vendor='$_POST[nama_vendor]', created=(select current_timestamp), created_by='$nama', updated=(select current_timestamp), updated_by='$nama'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='vendor' AND $act=='edit' ){
	mysql_query("update vendor set nama_vendor='$_POST[nama_vendor]', updated_by='$nama', updated=(select current_timestamp)  where kode_vendor='$_POST[kode_vendor]'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='vendor' AND $act=='hapus' ){
	mysql_query("delete from vendor where kode_vendor='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}


?>
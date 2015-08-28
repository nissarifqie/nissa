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


if($module=='zona' AND $act=='input' ){
	mysql_query("insert into zona set kode_zona='$_POST[kode_zona]', zona_pengiriman='$_POST[zona_pengiriman]', created=(select current_timestamp), created_by='$nama', updated=(select current_timestamp), updated_by='$nama'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='zona' AND $act=='edit' ){
	mysql_query("update zona set zona_pengiriman='$_POST[zona_pengiriman]', updated_by='$nama', updated=(select current_timestamp) where kode_zona='$_POST[kode_zona]'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='zona' AND $act=='hapus' ){
	mysql_query("delete from zona where kode_zona='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}


?>
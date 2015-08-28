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


if($module=='multi2' AND $act=='input' ){
	mysql_query("insert into multidrop2 set kode_vendor='$_POST[pil_vendor]', tipe_mobil='$_POST[tipe_mobil]', charge_vendor='$_POST[multidrop]', created=(select current_timestamp), created_by='$nama', updated=(select current_timestamp), updated_by='$nama'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='multi2' AND $act=='edit' ){
	mysql_query("update multidrop2 set kode_vendor='$_POST[pil_vendor]', tipe_mobil='$_POST[tipe_mobil]', charge_vendor='$_POST[multidrop]', updated_by='$nama', updated=(select current_timestamp) where id='$_POST[id]'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='multi2' AND $act=='hapus' ){
	mysql_query("delete from multidrop2 where id='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}


?>
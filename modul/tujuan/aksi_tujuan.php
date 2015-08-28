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


if($module=='tujuan' AND $act=='input' ){
$cekdata="select * from tujuan where kode_tujuan='$_POST[kode_tujuan]'"; 
$ada=mysql_query($cekdata) or die(mysql_error()); 
if(mysql_num_rows($ada)>0) { 
echo "<script type='text/javascript'> alert('Kode tujuan sudah ada, silakan ulangi kembali'); document.location='../../media.php?module=tujuan&act=input' </script>";
} else { 
	mysql_query("insert into tujuan set id_klien='$_POST[klien]', kode_tujuan='$_POST[kode_tujuan]', tujuan='$_POST[tujuan]', created=(select current_timestamp), created_by='$nama', updated=(select current_timestamp), updated_by='$nama' ");
	header('location:../../media.php?module='.$module);
}
}

elseif($module=='tujuan' AND $act=='edit' ){
	mysql_query("update tujuan set id_klien='$_POST[klien]', tujuan='$_POST[tujuan]', updated_by='$nama', updated=(select current_timestamp) where kode_tujuan='$_POST[kode_tujuan]'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='tujuan' AND $act=='hapus' ){
	mysql_query("delete from tujuan where kode_tujuan='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}


?>
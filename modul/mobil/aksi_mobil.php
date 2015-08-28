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
$op=isset($_GET['op'])?$_GET['op']:null;


if($module=='mobil' AND $act=='input' ){
$cekdata="select no_polisi from mobil where no_polisi='$_POST[no_polisi]'"; 
$ada=mysql_query($cekdata) or die(mysql_error()); 
if(mysql_num_rows($ada)>0) { 
echo "<script type='text/javascript'> alert('No Polisi sudah ada, silakan ulangi kembali'); document.location='../../media.php?module=mobil&act=input' </script>";
} else { 
 mysql_query("insert into mobil set id_klien='$_POST[pil_klien]', tipe_mobil='$_POST[tipe_mobil]', no_polisi='$_POST[no_polisi]', created=(select current_timestamp), created_by='$nama', updated=(select current_timestamp), updated_by='$nama'");
	header('location:../../media.php?module='.$module);
}
}

elseif($module=='mobil' AND $act=='edit' ){
	mysql_query("update mobil set id_klien='$_POST[pil_klien]',  tipe_mobil='$_POST[tipe_mobil]', no_polisi='$_POST[no_polisi]', updated_by='$nama', updated=(select current_timestamp) where id_mobil='$_POST[id_mobil]'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='mobil' AND $act=='hapus' ){
	mysql_query("delete from mobil where id_mobil='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}

?>
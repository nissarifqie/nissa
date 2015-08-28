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


if($module=='harga2' AND $act=='input' ){
$cekdata="select harga_vendor from harga_vendor where kode_vendor='$_POST[pil_vendor]' and kode_zona='$_POST[pil_zona]' and tipe_mobil='$_POST[tipe_mobil]'"; 
$ada=mysql_query($cekdata) or die(mysql_error()); 
if(mysql_num_rows($ada)>0) { 
echo "<script type='text/javascript'> alert('Harga untuk zona dan tipe mobil tersebut sudah ada, silakan ulangi kembali'); document.location='../../media.php?module=harga2&act=input' </script>";
} else { 
	mysql_query("insert into harga_vendor set kode_vendor='$_POST[pil_vendor]', kode_zona='$_POST[pil_zona]', tipe_mobil='$_POST[tipe_mobil]', harga_vendor='$_POST[harga]', created=(select current_timestamp), created_by='$nama', updated=(select current_timestamp), updated_by='$nama'");
	header('location:../../media.php?module='.$module);
}
}

elseif($module=='harga2' AND $act=='edit' ){
	mysql_query("update harga_vendor set kode_vendor='$_POST[pil_vendor]', kode_zona='$_POST[pil_zona]', tipe_mobil='$_POST[tipe_mobil]', harga_vendor='$_POST[harga]', updated_by='$nama', updated=(select current_timestamp) where id_harga='$_POST[id_harga]'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='harga2' AND $act=='hapus' ){
	mysql_query("delete from harga_vendor where id_harga='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}


?>
<?php
include "config/koneksi.php";
include "config/class_paging.php";

	if($_GET['module']=="klien"){
	include "modul/klien/klien.php";
	}	
	else if($_GET['module']=="mobil"){
	include "modul/mobil/mobil.php";
	}
	else if($_GET['module']=="zona"){
	include "modul/zona/zona.php";
	}
	else if($_GET['module']=="tujuan"){
	include "modul/tujuan/tujuan.php";
	}
	else if($_GET['module']=="vendor"){
	include "modul/vendor/vendor.php";
	}
	else if($_GET['module']=="harga"){
	include "modul/harga/harga.php";
	}
	else if($_GET['module']=="harga2"){
	include "modul/harga_vendor/harga_vendor.php";
	}
	else if($_GET['module']=="multi"){
	include "modul/multidrop/multidrop.php";
	}
	else if($_GET['module']=="supir"){
	include "modul/supir/supir.php";
	}
	else if($_GET['module']=="kirim"){
	include "modul/kirim/kirim.php";
	} 
	else if($_GET['module']=="transaksi"){
	include "modul/transaksi/transaksi.php";
	} 
	else if($_GET['module']=="edit_transaksi"){
	include "modul/transaksi/edit_transaksi.php";
	} 
	else if($_GET['module']=="multi1"){
	include "modul/multidrop_klien/multi.php";
	} 
	else if($_GET['module']=="multi2"){
	include "modul/multidrop_vendor/multi.php";
	} 
	else if($_GET['module']=="laporan"){
	include "modul/laporan/laporan.php";
	} 
	else if($_GET['module']=="lap_klien"){
	include "modul/laporan/tampil.php";
	} 
	else if($_GET['module']=="laporan_vendor"){
	include "modul/laporan/laporan2.php";
	} 
	else if($_GET['module']=="laporan_margin"){
	include "modul/laporan/laporan_margin.php";
	} 
	else if($_GET['module']=="user"){
	include "modul/user/user.php";
	} 
	else if($_GET['module']=="detail_do"){
	include "modul/transaksi/detail_do.php";
	} 
	else if($_GET['module']=="transaksi_1"){
	include "modul/transaksi/transaksi_1.php";
	} 
	 else {
	echo "<p class=judul1>GOS LOGISTICS</p>";
	}
	
 
?>
<?php
include "../../config/koneksi.php";
include "../../config/class_paging.php";
$aksi="modul/transaksi/proses.php";
	@session_start();
	error_reporting(0);
	if(isset($_SESSION['username1']))
	{
		$q = mysql_query("SELECT nama_user FROM user WHERE username='".$_SESSION['username1']."'");
		while($hasil = mysql_fetch_array($q)){
		   $nama = $hasil['nama_user'];	
		   }
		   }
$module=$_GET['module'];
$act=$_GET['act'];
$op=isset($_GET['op'])?$_GET['op']:null;

//menampilkan data klien di combobox
if($op=='klien'){
	$data=mysql_query("SELECT * FROM tbl_klien");
    echo"<option value='0'>== Klien ==</option>";
    while($r=mysql_fetch_array($data)){
        echo "<option value='$r[id_klien]'>$r[nama_klien]</option>";
    }
//menampilkan data nomor polisi di combobox
}elseif($op=='nopol'){
	$data=mysql_query("SELECT * FROM mobil order by no_polisi asc");
    echo"<option value='0'>== No Polisi ==</option>";
    while($r=mysql_fetch_array($data)){
        echo "<option value='$r[no_polisi]'>$r[no_polisi]</option>";
    }
//menampilkan jenis pengiriman di combobox
}elseif($op=='jenis'){
	$data=mysql_query("SELECT * FROM jenis_pengiriman order by id_pengiriman asc");
    echo"<option value='0'>== Jenis Pengiriman ==</option>";
    while($r=mysql_fetch_array($data)){
        echo "<option value='$r[id_pengiriman]'>$r[jenis_pengiriman]</option>";
    }
//menampilkan data vendor di combobox
}elseif($op=='vendor'){
	$data=mysql_query("SELECT nama_vendor,kode_vendor FROM vendor order by nama_vendor");
    echo"<option value='0'>== Vendor ==</option>";
    while($r=mysql_fetch_array($data)){
        echo "<option value='$r[kode_vendor]'>$r[nama_vendor]</option>";
    }
//menampilkan tipe mobil berdasarkan nomor polisi
}elseif($op=='tipe'){
    $nopol=$_GET['nopol'];
    $dt=mysql_query("SELECT id_mobil,tipe_mobil FROM mobil WHERE no_polisi='$nopol'");
    $d=mysql_fetch_array($dt);
    echo $d['id_mobil']."|".$d['tipe_mobil'];
	
//menampilkan data supir di combobox
}elseif($op=='supir'){
	$data=mysql_query("SELECT * FROM tbl_supir order by nama_supir asc");
    echo"<option value='0'>== Supir ==</option>";
    while($r=mysql_fetch_array($data)){
        echo "<option value='$r[id_supir]'>$r[nama_supir]</option>";
    }	
//menampilkan zona pengiriman di combobox
}elseif($op=='zona'){
	$data=mysql_query("SELECT * FROM zona");
    echo"<option value='0'>== Zona Pengiriman ==</option>";
	while($r=mysql_fetch_array($data)){
        echo "<option value='$r[kode_zona]'>$r[zona_pengiriman]</option>";
    }
//menampilkan harga ke klien
}elseif($op=='harga1'){
    $klien=$_GET['klien'];
    $zona=$_GET['zona'];
    $mobil=$_GET['mobil'];
    $dt=mysql_query("SELECT * FROM harga WHERE id_klien='$klien' and kode_zona='$zona' and tipe_mobil='$mobil'");
    $d=mysql_fetch_array($dt);
    echo $d['id_harga']."|".$d['harga_klien'];
//menampilkan harga ke vendor
}elseif($op=='harga2'){
    $vendor=$_GET['vendor'];
    $zona=$_GET['zona'];
    $mobil=$_GET['mobil'];
    $dt=mysql_query("SELECT * FROM harga_vendor WHERE kode_vendor='$vendor' and kode_zona='$zona' and tipe_mobil='$mobil'");
    $d=mysql_fetch_array($dt);
    echo $d['id_harga']."|".$d['harga_vendor'];
}elseif($op=='total1'){
    $harga=$_GET['harga1'];
    $multi=$_GET['multi1'];
	$total=$harga+$multi;
    echo $total;
		
//penyimpanan data transaksi
}elseif($module=='transaksi' AND $act=='tambah_trans'){
		$nomor1=0;
		$nomor2=0;
		$data=mysql_query("select max(no_trans) as nomor from transaksi");
		while($r=mysql_fetch_array($data)){
			if ($r['nomor'] == 0)
			{
				$nomor2 = "1";
			} 
			else 
			{
				$nomor1 = $r[nomor];
				$nomor2 = $nomor1+1;
			}
		}
	$klien=$_POST['klien'];
    $notrans=$nomor2;
    $tanggal=$_POST['tanggal'];
    $jenis=$_POST['jenis'];
	$vendor=$_POST['vendor'];
    $nopol=$_POST['nopol'];
    $tipe_mobil=$_POST['tipe_mobil'];
    $supir=$_POST['supir'];
    $zona=$_POST['zona'];
    $harga1=$_POST['harga1'];
    $harga2=$_POST['harga2'];
    $uj=$_POST['uj'];
    $gaji=$_POST['gaji'];
    $sewa=$_POST['sewa'];
    $ket=$_POST['ket'];
	$total_vendor=$harga2+$sewa+$uj+$gaji;
	$margin=$harga1-$total_vendor;
   $tambah=mysql_query("INSERT INTO transaksi
  (id_klien,no_trans,tanggal,id_pengiriman,kode_vendor,no_polisi,tipe_mobil,id_supir,kode_zona,harga_klien,harga_vendor,total_klien,total_vendor,uang_jalan,gaji_supir,sewa_mobil,keterangan,margin,created,created_by,updated,updated_by)
                        VALUES
	('$klien','$notrans','$tanggal','$jenis','$vendor','$nopol','$tipe_mobil','$supir','$zona','$harga1','$harga2','$harga1','$total_vendor','$uj','$gaji','$sewa','$ket',$margin,(SELECT current_timestamp),'$nama',(SELECT current_timestamp),'$nama')");					
	if ($tambah){
	header('location:../../media.php?module='.$module);
	} else {
	 die('Invalid query: ' . mysql_error());
	}
}elseif($op=='tujuan'){
	$tujuan = $_GET['tujuan'];
	$query = mysql_query("SELECT kode_tujuan, tujuan FROM tujuan WHERE kode_tujuan='$tujuan'");
    $d=mysql_fetch_array($query);
    echo $d['tujuan']."|".$d['kode_tujuan'];


//edit data transaksi
}elseif($module=='transaksi' AND $act=='edit_trans'){
    $notrans=$_POST['notrans'];
    $tanggal=$_POST['tanggal'];
    $jenis=$_POST['jenis'];
	$vendor=$_POST['vendor'];
    $nopol=$_POST['nopol'];
    $tipe_mobil=$_POST['tipe_mobil'];
    $supir=$_POST['supir'];
    $zona=$_POST['zona'];
    $harga1=$_POST['harga1'];
    $harga2=$_POST['harga2'];
    $uj=$_POST['uj'];
    $gaji=$_POST['gaji'];
    $sewa=$_POST['sewa'];
    $ket=$_POST['ket'];
    $multi1=$_POST['multi1'];
    $multi2=$_POST['multi2'];
	$total_vendor=$harga2+$sewa+$uj+$gaji+$multi2;
	$total_klien=$harga1+$multi1;
	$margin=$total_klien-$total_vendor;
	   $edit=mysql_query("UPDATE transaksi SET
	   tanggal='$tanggal',
	   id_pengiriman='$jenis',
	   kode_vendor='$vendor',
	   no_polisi='$nopol',
	   tipe_mobil='$tipe_mobil',
	   id_supir='$supir',
	   kode_zona='$zona',
	   harga_klien='$harga1',
	   harga_vendor='$harga2',
	   total_klien='$total_klien',
	   total_vendor='$total_vendor',
	   uang_jalan='$uj',
	   gaji_supir='$gaji',
	   sewa_mobil='$sewa',
	   keterangan='$ket',
	   margin='$margin',
	   updated=(SELECT current_timestamp),
	   updated_by='$nama'
	   WHERE no_trans='$notrans'");					
	if ($edit){
	header('location:../../media.php?module='.$module);
	} else {
	 die('Invalid query: ' . mysql_error());
	}
}elseif($op=='tujuan'){
	$tujuan = $_GET['tujuan'];
	$query = mysql_query("SELECT kode_tujuan, tujuan FROM tujuan WHERE kode_tujuan='$tujuan'");
    $d=mysql_fetch_array($query);
    echo $d['tujuan']."|".$d['kode_tujuan'];

//tabel tujuan
}elseif($op=='tbl_tujuan'){
   	$kode=$_GET['id'];
	$brg=mysql_query("SELECT * FROM trans_tujuan WHERE no_do='$kode'");
	echo "<thead>
	<th>No</th>
	<th>Kode Tujuan</th>
	<th>Tujuan</th>
	<th>Aksi</th>
	</thead>";
	$no=1;
    $total=mysql_fetch_array(mysql_query("SELECT count(*) as total FROM trans"));
    while($r=mysql_fetch_array($brg)){
        echo "<tr>
				<td>$no</td>
                <td>$r[kode_tujuan]</td>
                <td>$r[tujuan]</td>
                <td><a href='$aksi?op=hapus&kode=$r[id]' id='hapus'>Hapus</a></td>
	            </tr>";
				$no++;
    }
    echo "<tr><td colspan='4'>Total : $total[total] titik</td>";
		echo $total['total']."| </tr>";
//hapus transaksi
}elseif($module=='transaksi' AND $act=='hapus'){
  mysql_query("DELETE FROM trans_tujuan WHERE no_trans='$_GET[id]')"); 
  mysql_query("DELETE FROM trans_do WHERE no_trans='$_GET[id]'"); 
  mysql_query("DELETE FROM transaksi WHERE no_trans='$_GET[id]'"); 
  header('location:../../media.php?module='.$module);

//hapus DO
}elseif($op=='hapus_do'){
  $trans_do_id=$_GET['trans_do_id'];
  $no_do=$_GET['no_do'];
  $no_trans=$_GET['no_trans'];
  $harga_klien=$_GET['harga_klien'];
  $harga_vendor=$_GET['harga_vendor'];
  $uj=$_GET['uj'];
  $gaji=$_GET['gaji'];
  $sewa=$_GET['sewa'];
  $multi1 = (($_GET['multi_klien'])*($_GET['multi']));
  $multi2 = (($_GET['multi_vendor'])*($_GET['multi']));
  $total1=$harga_klien+$multi1;
  $total2=$harga_vendor+$sewa+$uj+$gaji+$multi2;
  $margin=$total1-$total2;
  mysql_query("DELETE FROM trans_tujuan WHERE trans_do_id='$trans_do_id'") or die("gagal"); 
  mysql_query("DELETE FROM trans_do WHERE trans_do_id='$trans_do_id'") or die("gagal"); 
  mysql_query("update transaksi set multidrop_klien='multi1', total_klien='$total1', multidrop_vendor='multi2', total_vendor='$total2', margin='$margin' where no_trans='$no_trans'") or die("gagal");
 
//edit DO
}elseif($op=='edit_do'){
  $trans_do_id=$_GET['trans_do_id'];
  $no_do=$_GET['no_do'];
  $no_load=$_GET['no_load'];
  $no_ship=$_GET['no_ship'];
  $qty=$_GET['qty'];
  mysql_query("UPDATE trans_do set no_do='$no_do',no_load='$no_load', no_shipment='$no_ship', kuantiti='$qty' WHERE trans_do_id='$trans_do_id'"); 


//tambah Do
}elseif($op=='tambah_do'){
	$no_trans=$_GET['no_trans'];
	$no_do=$_GET['no_do'];
	$no_load=$_GET['no_load'];
	$no_ship=$_GET['no_ship'];
	$qty=$_GET['qty'];
	if (!empty($no_trans) AND !empty($no_load) ) {
	$tambah=mysql_query("INSERT INTO trans_do (no_trans,no_do,no_load,no_shipment,kuantiti)
							VALUES ('$no_trans','$no_do','$no_load','$no_ship','$qty')");
	}
/*	$cekdata="SELECT no_load FROM trans_do WHERE no_load='$no_load'"; 
	$ada=mysql_query($cekdata) or die(mysql_error()); 
	if(mysql_num_rows($ada)>0) { 
		echo "<script type='text/javascript'> alert('No DO sudah ada, silakan ulangi kembali');</script>";
	} else { 
		if (!empty($no_trans) AND !empty($no_load) ) {
		$tambah=mysql_query("INSERT INTO trans_do (no_trans,no_do,no_load,no_shipment,kuantiti)
							VALUES ('$no_trans','$no_do','$no_load','$no_ship','$qty')");
		}
	}						
*/
}
?>


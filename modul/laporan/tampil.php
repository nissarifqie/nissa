<?php
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=Goslog_klien.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	include "../../config/koneksi.php";
	$tgl=$_POST['tanggal'];
	$tgl1=$_POST['tanggal1'];
	$klien=$_POST['klien'];
	$jenis=$_POST['jenis'];
	
	if ($klien == '0') {
		//menampilkan semua klien
		$no=1;
		$y=mysql_fetch_array(mysql_query("SELECT jenis_pengiriman from jenis_pengiriman where id_pengiriman='$jenis'"));
		$tampil=mysql_query("SELECT tr.no_trans, k.nama_klien, tr.tanggal, z.zona_pengiriman, tr.no_polisi,s.nama_supir,tr.tipe_mobil,td.no_do,td.no_load,td.no_shipment,td.kuantiti,tt.kode_tujuan,tt.tujuan,tr.harga_klien,tr.total_klien,tr.multidrop_klien,tr.keterangan FROM (transaksi tr LEFT JOIN trans_do td ON tr.no_trans = td.no_trans
LEFT JOIN trans_tujuan tt ON td.trans_do_id = tt.trans_do_id), tbl_supir s, zona z, tbl_klien k
WHERE s.id_supir=tr.id_supir AND k.id_klien=tr.id_klien AND
z.kode_zona=tr.kode_zona AND tr.id_pengiriman='$jenis' AND (tanggal >= '$tgl' AND tanggal <= '$tgl1') ");
		$total1=mysql_fetch_array(mysql_query("SELECT SUM(total_klien) as total,SUM(multidrop_klien) as total_multi,SUM(harga_klien) as totalharga FROM transaksi where tanggal >= '$tgl' AND tanggal <= '$tgl1'"));
		$namabulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		echo "<h2><u>REKAP PENGIRIMAN BARANG</u></h2>
<h3>Jenis Pengiriman : $y[jenis_pengiriman]</h3>
<h3>Periode : ";
		list($thn,$bln,$tanggal)=explode('-',$tgl);
		echo $tanggal.' '.$namabulan[(int)$bln].' '.$thn;
		echo" s/d ";
		list($thn,$bln,$tanggal)=explode('-',$tgl1);
		echo $tanggal.' '.$namabulan[(int)$bln].' '.$thn;
		echo "</h3>
<br/><table border=1 width=100%>
<thead>
<tr align=center>
<th>No</th>
<th>Klien</th>
<th>No Transaksi</th>
<th>Tanggal</th>
<th>Zona</th>
<th>No Polisi</th>
<th>Tipe Mobil</th>
<th>Nama Supir</th>
<th>No DO</th>
<th>No Load</th>
<th>No Shipment</th>
<th>Kode Tujuan</th>
<th>Tujuan</th>
<th>QTY</th>
<th>Charge</th>
<th>Multidrop</th>
<th>Total</th>
<th>Keterangan</th>
</tr>
</thead>";
		$namabulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$no = 1;
		$buffdo='';
		$buffnt = 0;
		while($dt=mysql_fetch_array($tampil)){
			
			if ( $dt[no_trans] == $buffnt ){
				$nomor = '';
				$namaklien = '';
				$notrans = '';
				$tanggal= '';
				$zonapengiriman = '';
				$nopolisi= '';
				$tipemobil= '';
				$supir= '';
				$harga = '' ;
				$multi = '' ;
				$total = '' ;
				$keterangan =  '' ;
			} else {
				$nomor=$no;
				$namaklien = $dt[nama_klien];
				$notrans = $dt[no_trans];
				$tanggal=$dt[tanggal];
				$zonapengiriman = $dt[zona_pengiriman];
				$nopolisi=$dt[no_polisi];
				$tipemobil=$dt[tipe_mobil];
				$supir=$dt[nama_supir];
				$harga=$dt[harga_klien];
				$multi=$dt[multidrop_klien];
				$total=$dt[total_klien];
				$keterangan = $dt[keterangan];
				$buffnt = $dt[no_trans];
				$no++;
			}

			
			if($dt[no_load] == $buffdo){
				$noload = '';
				$noship = '';
				$kuantiti = '';
				$nodo = '';
			} else {
				$noload = $dt[no_load];
				$buffdo = $dt[no_load];
				$noship = $dt[no_shipment];
				$kuantiti = $dt[kuantiti];
				$nodo = $dt[no_do];
			}

			echo "<tr>
<td width=30 align=center>".$nomor."</td>
<td align=center>".$namaklien."</td>
<td width=100 align=center>".$notrans."</td>
<td width=auto align=center>";
			list($thn,$bln,$tgl)=explode('-',$tanggal);
			echo $tgl.' '.$namabulan[(int)$bln].' '.$thn;
			echo "</td>
<td align=center>".$zonapengiriman."</td>
<td align=center>".$nopolisi."</td>
<td align=center>".$tipemobil."</td>
<td align=center>".$supir."</td>
<td align=center>".$nodo."</td>
<td align=center>".$noload."</td>
<td align=center>".$noship."</td>
<td align=center>$dt[kode_tujuan]</td>
<td align=center>$dt[tujuan]</td>
<td align=center>".$kuantiti."</td>
<td align=center>".$harga."</td>
<td align=center>".$multi."</td>
<td align=center>".$total."</td>
<td align=center>".$keterangan."</td></tr>";
		}

		echo "<tr><td colspan=13>&nbsp;</td><td>TOTAL</td><td>$total1[totalharga]</td><td>$total1[total_multi]</td><td>$total1[total]</td></tr></table>";
	} else {
		//menammpilkan per klien
		$no=1;
		$x=mysql_fetch_array(mysql_query("SELECT nama_klien from tbl_klien where id_klien='$klien'"));
		$y=mysql_fetch_array(mysql_query("SELECT jenis_pengiriman from jenis_pengiriman where id_pengiriman='$jenis'"));
		$tampil=mysql_query("SELECT tr.no_trans, tr.tanggal, z.zona_pengiriman, tr.no_polisi,s.nama_supir,tr.tipe_mobil,td.no_do,td.no_load,td.no_shipment,td.kuantiti,tt.kode_tujuan,tt.tujuan,tr.harga_klien,tr.total_klien,tr.multidrop_klien,tr.keterangan FROM (transaksi tr LEFT JOIN trans_do td ON tr.no_trans = td.no_trans
LEFT JOIN trans_tujuan tt ON td.trans_do_id = tt.trans_do_id), tbl_supir s, zona z, tbl_klien k
WHERE s.id_supir=tr.id_supir AND k.id_klien=tr.id_klien AND
z.kode_zona=tr.kode_zona AND tr.id_klien='$klien' AND tr.id_pengiriman='$jenis' AND (tanggal >= '$tgl' AND tanggal <= '$tgl1') ");
		$z=mysql_fetch_array(mysql_query("SELECT count(td.trans_do_id) as jum FROM (transaksi tr LEFT JOIN trans_do td ON tr.no_trans = td.no_trans
LEFT JOIN trans_tujuan tt ON td.trans_do_id = tt.trans_do_id), tbl_supir s, zona z, tbl_klien k
WHERE s.id_supir=tr.id_supir AND k.id_klien=tr.id_klien AND
z.kode_zona=tr.kode_zona AND tr.id_klien='$klien' AND tr.id_pengiriman='$jenis' AND (tanggal >= '$tgl' AND tanggal <= '$tgl1') "));
		$total1=mysql_fetch_array(mysql_query("SELECT SUM(total_klien) as total,SUM(multidrop_klien) as total_multi,SUM(harga_klien) as totalharga FROM transaksi where id_klien='$klien' AND tanggal >= '$tgl' AND tanggal <= '$tgl1'"));
		$namabulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		echo "<h2><u>REKAP PENGIRIMAN BARANG $x[nama_klien]</u></h2>
<h3>Jenis Pengiriman : $y[jenis_pengiriman]</h3>
<h3>Periode : ";
		list($thn,$bln,$tanggal)=explode('-',$tgl);
		echo $tanggal.' '.$namabulan[(int)$bln].' '.$thn;
		echo" s/d ";
		list($thn,$bln,$tanggal)=explode('-',$tgl1);
		echo $tanggal.' '.$namabulan[(int)$bln].' '.$thn;
		echo "</h3>
<br/><table border=1 width=100%>
<thead>
<tr align=center>
<th>No</th>
<th>No Transaksi</th>
<th>Tanggal</th>
<th>Zona</th>
<th>No Polisi</th>
<th>Tipe Mobil</th>
<th>Nama Supir</th>
<th>No DO</th>
<th>No Load</th>
<th>No Shipment</th>
<th>Kode Tujuan</th>
<th>Tujuan</th>
<th>QTY</th>
<th>Charge</th>
<th>Multidrop</th>
<th>Total</th>
<th>Keterangan</th>
</tr>
</thead>";
		$namabulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$no = 1;
		//$buffdo='';
		$buffnt = 0;
		while($dt=mysql_fetch_array($tampil)){
			
			if ( $dt[no_trans] == $buffnt ){
				$nomor = '';
				$namaklien = '';
				$notrans = '';
				$tanggal= '';
				$zonapengiriman = '';
				$nopolisi= '';
				$tipemobil= '';
				$supir= '';
				$harga = '' ;
				$multi = '' ;
				$total = '' ;
				$keterangan =  '' ;
			} else {
				$nomor=$no;
				$namaklien = $dt[nama_klien];
				$notrans = $dt[no_trans];
				$tanggal=$dt[tanggal];
				$zonapengiriman = $dt[zona_pengiriman];
				$nopolisi=$dt[no_polisi];
				$tipemobil=$dt[tipe_mobil];
				$supir=$dt[nama_supir];
				$harga=$dt[harga_klien];
				$multi=$dt[multidrop_klien];
				$total=$dt[total_klien];
				$keterangan = $dt[keterangan];
				$buffnt = $dt[no_trans];
				$no++;
			}

			
			if($dt[no_load] == $buffdo){
				$noload = '';
				$noship = '';
				$kuantiti = '';
				$nodo = '';
			} else {
				$noload = $dt[no_load];
				$buffdo = $dt[no_load];
				$noship = $dt[no_shipment];
				$kuantiti = $dt[kuantiti];
				$nodo = $dt[no_do];
			}

			echo "<tr>
<td width=30 align=center>".$nomor."</td>
<td width=100 align=center>".$notrans."</td>
<td width=auto align=center>";
			list($thn,$bln,$tgl)=explode('-',$tanggal);
			echo $tgl.' '.$namabulan[(int)$bln].' '.$thn;
			echo "</td>
<td align=center>".$zonapengiriman."</td>
<td align=center>".$nopolisi."</td>
<td align=center>".$tipemobil."</td>
<td align=center>".$supir."</td>
<td align=center>".$nodo."</td>
<td align=center>".$noload."</td>
<td align=center>".$noship."</td>
<td align=center>$dt[kode_tujuan]</td>
<td align=center>$dt[tujuan]</td>
<td align=center>".$kuantiti."</td>
<td align=center>".$harga."</td>
<td align=center>".$multi."</td>
<td align=center>".$total."</td>
<td align=center>".$keterangan."</td></tr>";
		}

		echo "<tr><td colspan=12>&nbsp;</td><td>TOTAL</td><td>$total1[totalharga]</td><td>$total1[total_multi]</td><td>$total1[total]</td></tr></table>";
	}

	?>
<html>
<head>
			<script type="text/javascript" src="jquery-1.3.2.js"></script>
			<script type="text/javascript" src="datepicker/ui.core.js"></script>
			<script type="text/javascript" src="datepicker/ui.datepicker.js"></script>
			<link type="text/css" href="datepicker/ui.core.css" rel="stylesheet" />
			<link type="text/css" href="datepicker/ui.resizable.css" rel="stylesheet" />
			<link type="text/css" href="datepicker/ui.accordion.css" rel="stylesheet" />
			<link type="text/css" href="datepicker/ui.dialog.css" rel="stylesheet" />
			<link type="text/css" href="datepicker/ui.slider.css" rel="stylesheet" />
			<link type="text/css" href="datepicker/ui.tabs.css" rel="stylesheet" />
			<link type="text/css" href="datepicker/ui.datepicker.css" rel="stylesheet" />
			<link type="text/css" href="datepicker/ui.progressbar.css" rel="stylesheet" />
			<link type="text/css" href="datepicker/ui.theme.css" rel="stylesheet" />
			<link type="text/css" href="datepicker/demos.css" rel="stylesheet" />
            <script>	
					
			        $(function(){
					$('#tanggal').datepicker({
					  changeMonth: true,
					  changeYear: true,
					  dateFormat : 'yy-mm-dd' 
					  //, yearRange : '-66:+5'
					}); 
					$('#tanggal1').datepicker({
					  changeMonth: true,
					  changeYear: true,
					  dateFormat : 'yy-mm-dd' 
					  //, yearRange : '-66:+5'
					}); 



					}); 				
			</script>
</head>
<body>
<?php
include "../../config/koneksi.php";
echo "<h2 class='head'>LAPORAN KLIEN</h2>
	<div>
	<table class='tabelform'><form method='POST' action='modul/laporan/tampil.php'>
	<tr><td>Jenis Pengiriman</td>";
	$result = mysql_query("select * from jenis_pengiriman order by jenis_pengiriman asc");
	echo '<td><select name="jenis" id="jenis">';
	echo '<option></option>';
	while ($row = mysql_fetch_array($result)) {
    echo '<option value="' . $row['id_pengiriman'] . '">' . $row['jenis_pengiriman'] . '</option>';
	}
	echo '</select></td></tr>';
	echo "<tr><td>Klien</td>";
	$result = mysql_query("select * from tbl_klien order by id_klien asc");
	echo '<td><select name="klien" id="klien">';
	echo '<option></option>';
	echo "<option value='0'>Semua Klien</option>";
	while ($row = mysql_fetch_array($result)) {
    echo '<option value="' . $row['id_klien'] . '">' . $row['nama_klien'] . '</option>';
	}
	echo '</select></td>';
	echo "</tr>";
	echo "<tr><td>Periode</td><td><input type=text name='tanggal' id='tanggal' /> - <input type=text name='tanggal1' id='tanggal1' /></td>	</tr>
	<tr><td colspan=4 align=left><input type=submit value='Submit' name='submit' id='submit'>
	</td></tr>
	</table>
	</div>";
?>
<?php 
//
//$tgl=$_POST['tanggal'];
//$tgl1=$_POST['tanggal1'];
//$klien=$_POST['klien'];
//$jenis=$_POST['jenis'];
//
//if ($klien == '0') {
//
////menampilkan semua klien
//$no=1;
//$y=mysql_fetch_array(mysql_query("SELECT jenis_pengiriman from jenis_pengiriman where id_pengiriman='$jenis'"));
//$tampil=mysql_query("SELECT * FROM (transaksi tr LEFT JOIN trans_do td ON tr.no_trans = td.no_trans
//LEFT JOIN trans_tujuan tt ON td.no_do = tt.no_do), tbl_supir s, zona z, tbl_klien k
//WHERE s.id_supir=tr.id_supir AND k.id_klien=tr.id_klien AND
//z.kode_zona=tr.kode_zona AND tr.id_pengiriman='$jenis' AND (tanggal >= '$tgl' AND tanggal <= '$tgl1') ");
//$total1=mysql_fetch_array(mysql_query("SELECT SUM(total_klien) as total,SUM(multidrop_klien) as total_multi,SUM(harga_klien) as totalharga FROM transaksi where tanggal >= '$tgl' AND tanggal <= '$tgl1'"));
//$namabulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
//echo "<h2><u>REKAP PENGIRIMAN BARANG</u></h2>
//<h3>Jenis Pengiriman : $y[jenis_pengiriman]</h3>
//<h3>Periode : "; list($thn,$bln,$tanggal)=explode('-',$tgl); echo $tanggal.' '.$namabulan[(int)$bln].' '.$thn;
//echo" s/d "; list($thn,$bln,$tanggal)=explode('-',$tgl1); echo $tanggal.' '.$namabulan[(int)$bln].' '.$thn;
//echo "</h3>
//<br/><table border=1 width=100%>
//<thead>
//<tr align=center>
//<th>No</th>
//<th>Klien</th>
//<th>No Transaksi</th>
//<th>Tanggal</th>
//<th>Zona</th>
//<th>No Polisi</th>
//<th>Tipe Mobil</th>
//<th>Nama Supir</th>
//<th>No DO</th>
//<th>No Load</th>
//<th>No Shipment</th>
//<th>Kode Tujuan</th>
//<th>Tujuan</th>
//<th>QTY</th>
//<th>Charge</th>
//<th>Multidrop</th>
//<th>Total</th>
//<th>Keterangan</th>
//</tr>
//</thead>";
//$namabulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
//$no = 1;
//$buffdo='';
//$buffnt = 0;
//while($dt=mysql_fetch_array($tampil)){
//if ( $dt[no_trans] == $buffnt )
//{
//$nomor = '';
//$namaklien = '';
//$notrans = '';
//$tanggal= '';
//$zonapengiriman = '';
//$nopolisi= '';
//$tipemobil= '';
//$supir= '';
//$nodo = '';
//$noload = '';
//$noship = '';
//$kuantiti = '';
//$harga = '' ;
//$multi = '' ;
//$total = '' ;
//$keterangan =  '' ;
//}else { 
//$nomor=$no;
//$namaklien = $dt[nama_klien];
//$notrans = $dt[no_trans];
//$tanggal=$dt[tanggal];
//$zonapengiriman = $dt[zona_pengiriman];
//$nopolisi=$dt[no_polisi];
//$tipemobil=$dt[tipe_mobil];
//$supir=$dt[nama_supir];
//$nodo = $dt[no_do];
//$noload = $dt[no_load];
//$noship = $dt[no_shipment];
//$kuantiti = $dt[kuantiti];
//$harga=$dt[harga_klien];
//$multi=$dt[multidrop_klien];
//$total=$dt[total_klien];
//$keterangan = $dt[keterangan];
//$buffdo = $dt[no_do];
//$buffnt = $dt[no_trans];
//$no++;
//}
//
//echo "<tr>
//<td width=30 align=center>".$nomor."</td>
//<td align=center>".$nama_klien."</td>
//<td width=100 align=center>".$notrans."</td>
//<td width=auto align=center>";
//list($thn,$bln,$tgl)=explode('-',$tanggal);
//echo $tgl.' '.$namabulan[(int)$bln].' '.$thn;
//
//echo "</td>
//<td align=center>".$zonapengiriman."</td>
//<td align=center>".$nopolisi."</td>
//<td align=center>".$tipemobil."</td>
//<td align=center>".$supir."</td>
//<td align=center>".$nodo."</td>
//<td align=center>".$noload."</td>
//<td align=center>".$noship."</td>
//<td align=center>$dt[kode_tujuan]</td>
//<td align=center>$dt[tujuan]</td>
//<td align=center>".$kuantiti."</td>
//<td align=center>".$harga."</td>
//<td align=center>".$multi."</td>
//<td align=center>".$total."</td>
//<td align=center>".$keterangan."</td></tr>";
//}
//echo "<tr><td colspan=13>&nbsp;</td><td>TOTAL</td><td>$total1[totalharga]</td><td>$total1[total_multi]</td><td>$total1[total]</td></tr></table>";
//
//} else {
//
//
////menammpilkan per klien
//$no=1;
//$x=mysql_fetch_array(mysql_query("SELECT nama_klien from tbl_klien where id_klien='$klien'"));
//$y=mysql_fetch_array(mysql_query("SELECT jenis_pengiriman from jenis_pengiriman where id_pengiriman='$jenis'"));
//$tampil=mysql_query("SELECT * FROM (transaksi tr LEFT JOIN trans_do td ON tr.no_trans = td.no_trans
//LEFT JOIN trans_tujuan tt ON td.no_do = tt.no_do), tbl_supir s, zona z, tbl_klien k
//WHERE s.id_supir=tr.id_supir AND k.id_klien=tr.id_klien AND
//z.kode_zona=tr.kode_zona AND tr.id_klien='$klien' AND tr.id_pengiriman='$jenis' AND (tanggal >= '$tgl' AND tanggal <= '$tgl1') ");
//$total1=mysql_fetch_array(mysql_query("SELECT SUM(total_klien) as total,SUM(multidrop_klien) as total_multi,SUM(harga_klien) as totalharga FROM transaksi where id_klien='$klien' AND tanggal >= '$tgl' AND tanggal <= '$tgl1'"));
//$namabulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
//echo "<h2><u>REKAP PENGIRIMAN BARANG $x[nama_klien]</u></h2>
//<h3>Jenis Pengiriman : $y[jenis_pengiriman]</h3>
//<h3>Periode : "; list($thn,$bln,$tanggal)=explode('-',$tgl); echo $tanggal.' '.$namabulan[(int)$bln].' '.$thn;
//echo" s/d "; list($thn,$bln,$tanggal)=explode('-',$tgl1); echo $tanggal.' '.$namabulan[(int)$bln].' '.$thn;
//echo "</h3>
//<br/><table border=1 width=100%>
//<thead>
//<tr align=center>
//<th>No</th>
//<th>No Transaksi</th>
//<th>Tanggal</th>
//<th>Zona</th>
//<th>No Polisi</th>
//<th>Tipe Mobil</th>
//<th>Nama Supir</th>
//<th>No DO</th>
//<th>No Load</th>
//<th>No Shipment</th>
//<th>Kode Tujuan</th>
//<th>Tujuan</th>
//<th>QTY</th>
//<th>Charge</th>
//<th>Multidrop</th>
//<th>Total</th>
//<th>Keterangan</th>
//</tr>
//</thead>";
//$namabulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
//$no = 1;
//$buffdo='';
//$buffnt = 0;
//while($dt=mysql_fetch_array($tampil)){
//if ( $dt[no_trans] == $buffnt )
//{
//$nomor = '';
//$notrans = '';
//$tanggal= '';
//$zonapengiriman = '';
//$nopolisi= '';
//$tipemobil= '';
//$supir= '';
//$nodo = '';
//$noload = '';
//$noship = '';
//$kuantiti = '';
//$harga = '' ;
//$multi = '' ;
//$total = '' ;
//$keterangan =  '' ;
//
//}else
//{ 
//
//$nomor=$no;
//$notrans = $dt[no_trans];
//$tanggal=$dt[tanggal];
//$zonapengiriman = $dt[zona_pengiriman];
//$nopolisi=$dt[no_polisi];
//$tipemobil=$dt[tipe_mobil];
//$supir=$dt[nama_supir];
//$nodo = $dt[no_do];
//$noload = $dt[no_load];
//$noship = $dt[no_shipment];
//$kuantiti = $dt[kuantiti];
//$harga=$dt[harga_klien];
//$multi=$dt[multidrop_klien];
//$total=$dt[total_klien];
//$keterangan = $dt[keterangan];
//$buffdo = $dt[no_do];
//$buffnt = $dt[no_trans];
//$no++;
//}
//
//echo "<tr>
//<td width=30 align=center>".$nomor."</td>
//<td width=100 align=center>".$notrans."</td>
//<td width=auto align=center>";
//list($thn,$bln,$tgl)=explode('-',$tanggal);
//echo $tgl.' '.$namabulan[(int)$bln].' '.$thn;
//
//echo "</td>
//<td align=center>".$zonapengiriman."</td>
//<td align=center>".$nopolisi."</td>
//<td align=center>".$tipemobil."</td>
//<td align=center>".$supir."</td>
//<td align=center>".$nodo."</td>
//<td align=center>".$noload."</td>
//<td align=center>".$noship."</td>
//<td align=center>$dt[kode_tujuan]</td>
//<td align=center>$dt[tujuan]</td>
//<td align=center>".$kuantiti."</td>
//<td align=center>".$harga."</td>
//<td align=center>".$multi."</td>
//<td align=center>".$total."</td>
//<td align=center>".$keterangan."</td></tr>";
//}
//echo "<tr><td colspan=12>&nbsp;</td><td>TOTAL</td><td>$total1[totalharga]</td><td>$total1[total_multi]</td><td>$total1[total]</td></tr></table>";
//} 
?>

</body>
</html>


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
echo "<h2 class='head'>LAPORAN VENDOR</h2>
	<div>
	<table class='tabelform'><form method='POST' action='modul/laporan/tampil_vendor.php'>
	<tr><td>Jenis Pengiriman</td>";
	$result = mysql_query("select * from jenis_pengiriman order by jenis_pengiriman asc");
	echo '<td><select name="jenis">';
	echo '<option> </option>';
	while ($row = mysql_fetch_array($result)) {
    echo '<option value="' . $row['id_pengiriman'] . '">' . $row['jenis_pengiriman'] . '</option>';
	}
	echo '</select></td></tr>';
	echo "<td>Vendor</td>";
	$result = mysql_query("select * from vendor order by kode_vendor asc");
	echo '<td><select name="vendor">';
	echo '<option></option>';
	echo '<option value=0>Semua Vendor</option>';
	while ($row = mysql_fetch_array($result)) {
    echo '<option value="' . $row['kode_vendor'] . '">' . $row['nama_vendor'] . '</option>';
	}
	echo '</select></td>';
	echo "</tr>";
	echo "<tr><td>Periode</td><td><input type=text name='tanggal' id='tanggal' /> - <input type=text name='tanggal1' id='tanggal1' /></td>	</tr>
	<tr><td colspan=4 align=left><input type=submit value='Submit' name='cetak' id='cetak'>
	</td></tr>
	</table>
	</div>";
?>

<?php /*?><?php $tgl=$_POST['tanggal'];
$tgl1=$_POST['tanggal1'];
$klien=$_POST['klien'];
$no=1;
$tampil=mysql_query("SELECT * FROM (transaksi tr LEFT JOIN trans_do td ON tr.no_trans = td.no_trans
LEFT JOIN trans_tujuan tt ON td.no_do = tt.no_do), tbl_supir s, zona z, tbl_klien k
WHERE s.id_supir=tr.id_supir AND k.id_klien=tr.id_klien AND
z.kode_zona=tr.kode_zona AND tr.id_klien='$klien' AND (tanggal >= '$tgl' AND tanggal <= '$tgl1') ");
$namabulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
echo "<h2><u>REKAP PENGIRIMAN BARANG</u></h2>
<h2>Periode : "; list($thn,$bln,$tanggal)=explode('-',$tgl); echo $tanggal.' '.$namabulan[(int)$bln].' '.$thn;
echo" s/d "; list($thn,$bln,$tanggal)=explode('-',$tgl1); echo $tanggal.' '.$namabulan[(int)$bln].' '.$thn;
echo "</h2>
<br/><table class='tabel' >
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
$buffdo='';
$buffnt = 0;
while($dt=mysql_fetch_array($tampil)){
$total1=mysql_fetch_array(mysql_query("SELECT SUM(total_klien) as total,SUM(multidrop_klien) as total_multi FROM transaksi where tanggal >= '$tgl' AND tanggal <= '$tgl1'"));
if ( $dt[no_trans] == $buffnt )
{
$nomor = '';
$notrans = '';
$tanggal= '';
$zonapengiriman = '';
$nopolisi= '';
$tipemobil= '';
$supir= '';
$nodo = '';
$noload = '';
$noship = '';
$kuantiti = '';
$harga = '' ;
$multi = '' ;
$total = '' ;
$keterangan =  '' ;

}else
{ 

$nomor=$no;
$notrans = $dt[no_trans];
$tanggal=$dt[tanggal];
$zonapengiriman = $dt[zona_pengiriman];
$nopolisi=$dt[no_polisi];
$tipemobil=$dt[tipe_mobil];
$supir=$dt[nama_supir];
$nodo = $dt[no_do];
$noload = $dt[no_load];
$noship = $dt[no_shipment];
$kuantiti = $dt[kuantiti];
$harga=$dt[harga_klien];
$multi=$dt[multidrop_klien];
$total=$dt[total_klien];
$keterangan = $dt[keterangan];
$buffdo = $dt[no_do];
$buffnt = $dt[no_trans];
$no++;
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
echo "<tr><td colspan=13>&nbsp;</td><td>TOTAL</td><td>$total1[total_multi]</td><td>$total1[total]</td></tr></table>";
?>
<?php */?></body>
</html>


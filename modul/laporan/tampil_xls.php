<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Goslog_klien.xls");
header("Pragma: no-cache");
header("Expires: 0");
include "../../config/koneksi.php";
$tgl=$_POST['tanggal'];
$tgl1=$_POST['tanggal1'];
$klien=$_POST['klien'];
$no=1;
//$tampil=mysql_query("SELECT * FROM transaksi,tbl_klien,tbl_supir,zona WHERE transaksi.id_klien='$klien' AND tbl_klien.id_klien=transaksi.id_klien AND tbl_supir.id_supir=transaksi.id_supir AND zona.kode_zona=transaksi.kode_zona AND tanggal >= '$tgl' AND tanggal <= '$tgl1'");
$tampil=mysql_query("SELECT * FROM (transaksi tr LEFT JOIN trans_do td ON tr.no_trans = td.no_trans
LEFT JOIN trans_tujuan tt ON td.no_do = tt.no_do), tbl_supir s, zona z, tbl_klien k
WHERE s.id_supir=tr.id_supir AND k.id_klien=tr.id_klien AND
z.kode_zona=tr.kode_zona AND tr.id_klien='$klien' AND (tanggal >= '$tgl' AND tanggal <= '$tgl1') ");
$namabulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
echo "<h2><u>REKAP PENGIRIMAN BARANG</u></h2>
<h2>Periode : "; list($thn,$bln,$tanggal)=explode('-',$tgl); echo $tanggal.' '.$namabulan[(int)$bln].' '.$thn;
echo" s/d "; list($thn,$bln,$tanggal)=explode('-',$tgl1); echo $tanggal.' '.$namabulan[(int)$bln].' '.$thn;
echo "</h2>
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
echo "<tr><td colspan=13>&nbsp;</td><td>TOTAL</td><td>$total1[total_multi]</td><td>$total1[total]</td></tr>";
?>
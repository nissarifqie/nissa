<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gos Logistics</title>
			<script src="js/superfish.js" type="text/javascript"></script>
			<script type="text/javascript" src="jquery-1.3.2.js"></script>
			<script type="text/javascript" src="js/jquery-ui.js"></script>
			<script src="js/superfish.js" type="text/javascript"></script>
			<script src="js/hoverIntent.js" type="text/javascript"></script>
			<link rel="stylesheet" href="js/jquery-ui-1.11.3/jquery-ui.css">
			<link rel="stylesheet" href="css/style.css" type="text/css"  />
<?php	
function ambil_tujuan(){
	$nama='';
	$sql_nama=mysql_query("select * from tujuan");
	while($data_nama=mysql_fetch_array($sql_nama)){
	$nama.='{ 
	value: "'.stripslashes($data_nama['tujuan']).'", 
	label: "'.$data_nama['kode_tujuan'].'"},';
	}
	return(strrev(substr(strrev($nama),1)));
	} 
?>

			

<script>
/*$(function() { 
				$( "#kode_tujuan" ).autocomplete({
				 source: "modul/transaksi/sourcedata.php", 
				   minLength:1,
				});
			});
*/			
$(function() {
    var DaftarNama = [<?php echo ambil_tujuan();?> ];
	$("#kode_tujuan").autocomplete({ 
    	source: function(request, response) {
	
     		var results = $.ui.autocomplete.filter(DaftarNama, request.term);
        	response(results.slice(0, 10));
    	},
		focus: function(event, ui) {
			event.preventDefault();
			$(this).val(ui.item.label);
		},
		select: function(event, ui) {
			event.preventDefault();
			$(this).val(ui.item.label);
			$("#tujuan").val(ui.item.value);
		}
	});
});
</script>

			
			
</head>

<body>
<?php 
		$query1 = mysql_query("SELECT transaksi.no_trans,transaksi.harga_klien,transaksi.harga_vendor,transaksi.uang_jalan,transaksi.gaji_supir,transaksi.sewa_mobil,transaksi.total_klien,transaksi.total_vendor,transaksi.kode_vendor,transaksi.id_klien,transaksi.tipe_mobil,zona.zona_pengiriman,trans_do.no_trans,trans_do.no_load FROM transaksi, trans_do,zona WHERE zona.kode_zona=transaksi.kode_zona AND transaksi.no_trans = trans_do.no_trans AND trans_do_id = '$_GET[id]'");
		
		$q=mysql_fetch_array($query1);
		$multi1= mysql_fetch_array(mysql_query("select * from multidrop1 where tipe_mobil='$q[tipe_mobil]' and id_klien='$q[id_klien]'"));				
		$multi2=mysql_fetch_array(mysql_query("select * from multidrop2 where tipe_mobil='$q[tipe_mobil]' and kode_vendor=$q[kode_vendor]"));
		$multi = mysql_fetch_array(mysql_query("SELECT sum(multi) as jumlah FROM trans_do where no_trans='$q[no_trans]'"));
		$query = mysql_query("SELECT kode_tujuan, tujuan from tujuan order by tujuan");
		$tot = mysql_fetch_array(mysql_query("SELECT count(tujuan) as jumlah FROM trans_tujuan where no_trans='$q[no_trans]'"));
		$multi_all = $tot[jumlah]-3;
		if($multi_all<0){
		$jumlah_multi=0;
		} else {
		$jumlah_multi=$multi_all;
		}
		echo "<h2 class=head>Tujuan Pengiriman</h2>
		<table class='detailtrans'><form method='POST'>
		<tr><td>No Transaksi</td><td>: $q[no_trans]</td>
		<input type=hidden name='harga1' value='$q[harga_klien]'>
		<input type=hidden name='harga2' value='$q[harga_vendor]'>
		<input type=hidden name='uj' value='$q[uang_jalan]'>
		<input type=hidden name='gaji' value='$q[gaji_supir]'>
		<input type=hidden name='sewa' value='$q[sewa_mobil]'>
		<input type=hidden name='notrans' value='$q[no_trans]'>
		<input type=hidden name='multi' value='$jumlah_multi'>
		<input type=hidden name='multi_klien' value='$multi1[charga_klien]'>
		<input type=hidden name='multi_vendor' value='$multi2[charga_vendor]'></tr>
		<input type='hidden' id='trans_do_id' name='trans_do_id' value='$_GET[id]' readonly>
		<tr><td>No Load</td><td>: <input type='text' id='no_load' name='no_load' value='$q[no_load]' readonly></td></tr>
		<tr><td>Zona Pengiriman</td><td>: $q[zona_pengiriman]</td>
		<tr><td>Kode Tujuan</td><td>: <input type='text' id='kode_tujuan' class='input' name='kode_tujuan'></td></tr>";
//		echo "<tr><td>Tujuan</td><td>: <select name='tujuan' id='tujuan'>";
//		echo "<option value=0></option>";
//		while ($r=mysql_fetch_array($query)) {
//		echo "<option value='$r[kode_tujuan]'>$r[tujuan]</option>";
//		}
//		echo"</select></td></tr>";
		echo "<tr><td>Tujuan</td><td>: <input type='text' id='tujuan' name='tujuan' class='input' readonly><input type='hidden' id='nama_tujuan' name='nama_tujuan'></td>
		<tr><td>&nbsp;</td><td><input type=submit id='tambah_tujuan' name='tambah_tujuan' value='Tambah Tujuan'> <input type=submit id='hapus_tujuan' name='hapus_tujuan' value='Hapus Tujuan'></td></tr>
		</table>";
		$notrans = $_POST['notrans'];
		$trans_do_id = $_POST['trans_do_id'];
		$kode = $_POST['kode_tujuan'];
		$nama1 = $_POST['tujuan'];
		$harga1 = $_POST['harga1'];
		$harga2 = $_POST['harga2'];
		$uj = $_POST['uj'];
		$gaji = $_POST['gaji'];
		$sewa = $_POST['sewa'];
		$multi = $_POST['multi']+1;
		$multi1 = ($_POST['multi_klien'])*($_POST['multi']);
		$multi2 = ($_POST['multi_vendor'])*($_POST['multi']);
		$total1=$harga1+$multi1;
		$total2=$harga2+$sewa+$uj+$gaji+$multi2;
		$margin=$total1-$total2;
		if (isset($_POST['tambah_tujuan']) AND !empty($nama1) AND !empty($kode) ) {
//		if (isset($_POST['tambah_tujuan']) ) {
//		$tambah = mysql_query("insert into trans_tujuan (no_trans,no_do,kode_tujuan) values ('$notrans','$no_do','$coba')");
		$tambah = "insert into trans_tujuan (no_trans,trans_do_id,kode_tujuan,tujuan) values ('$notrans','$trans_do_id','$kode','$nama1')";
		$update="update transaksi set multidrop_klien='$multi1', total_klien='$total1', multidrop_vendor='$multi2', total_vendor='$total2', margin='$margin',multi='$multi' where no_trans='$[no_trans]'";
		mysql_query($tambah) or die ("gagal tambah");
		//mysql_query($update) or die ("gagal update");
		
		} elseif (isset($_POST['hapus_tujuan'])) {
		$hapus = mysql_query("delete from trans_tujuan where trans_do_id='$trans_do_id'");
		$update=mysql_query("update trans_do set multi='multi' where no_trans='$notrans' and trans_do_id=$trans_do_id");
		$update1=mysql_query("update transaksi set multidrop_klien='multi1', total_klien='$total1', multidrop_vendor='multi2', total_vendor='$total2', margin='$margin' where no_trans='$q[no_trans]'");
		}
		$data=mysql_query("select * from trans_tujuan where trans_do_id='$_GET[id]'");
		echo"<table class='tabelmodif1' id='tbl_tujuan'>
		<thead>
		<th>No</th>
		<th>Kode Tujuan</th>
		<th>Tujuan</th>";
//		<th>Aksi</th>
		echo"</thead>";
		$no=1;
		$total=mysql_fetch_array(mysql_query("select count(*) as total from trans_tujuan where trans_do_id='$_GET[id]'"));
		while($r=mysql_fetch_array($data)){
			echo "<tr>
					<td>$no</td>
					<td>$r[kode_tujuan]</td>
					<td>$r[tujuan]</td>"; 
					 //<td><a href=$aksi?module=transaksi&act=hapus_tujuan&id=$r[kode_tujuan]>Hapus</a></td>
					echo"</tr>";
					$no++;
    	}
		$a = $tot['jumlah'];
		$b = $a - 3;
		if($b<0){
		$c = 0;
		} else {
		$c = $b;
		}
		echo"<tr><td colspan=4>Total : $total[total] Titik</td></tr>";
		//<tr><td colspan=4>Multidrop : $c</td></tr>";
		//perhitungan multidrop
		$update=mysql_query("update trans_do set multi='$c' where trans_do_id='$_GET[id]' AND no_trans='$q[no_trans]'");
		$multi = mysql_fetch_array(mysql_query("SELECT sum(multi) as jumlah FROM trans_do where no_trans='$q[no_trans]'"));
		$multi1= mysql_fetch_array(mysql_query("select * from multidrop1 where tipe_mobil='$q[tipe_mobil]' and id_klien='$q[id_klien]'"));
		$multi2=mysql_fetch_array(mysql_query("select * from multidrop2 where tipe_mobil='$q[tipe_mobil]' and kode_vendor=$q[kode_vendor]"));
		$charge_klien=(($c)*($multi1['charge_klien']));
		$charge_vendor=(($c)*($multi2['charge_vendor']));
		$total1=(($q['harga_klien'])+($charge_klien));
		$total2=(($q['harga_vendor'])+($q['uang_jalan'])+($q['gaji_supir'])+($q['sewa_mobil'])+($charge_vendor));
		$margin=$total1-$total2;
		$update=mysql_query("update transaksi set multidrop_klien='$charge_klien', total_klien='$total1', multidrop_vendor='$charge_vendor', total_vendor='$total2', margin='$margin' where no_trans='$q[no_trans]'");
		echo"</form></table><br/><input type=button value=Kembali onclick=\"window.location.href='?module=transaksi&act=detail&id=$q[no_trans]';\"></td></tr>
		";	
		
        
?>

</body>
</html>

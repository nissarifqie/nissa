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
echo "<h2 class='head'>LAPORAN GABUNGAN</h2>
	<div>
	<table class='tabelform'><form method='POST' action='modul/laporan/tampil_margin.php'>
	<tr><td>Jenis Pengiriman</td>";
	$result = mysql_query("select * from jenis_pengiriman order by jenis_pengiriman asc");
	echo '<td><select name="jenis">';
	echo '<option> </option>';
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
	echo "<tr><td>Vendor</td>";
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
?></body>
</html>


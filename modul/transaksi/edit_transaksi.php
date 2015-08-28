<?php
$aksi="modul/transaksi/proses.php";
?>
    <html>
        <head>
            <title>GOS LOGISTICS</title>
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
					//untuk tanggal
					$('#tanggal').datepicker({
					  changeMonth: true,
					  changeYear: true,
					  dateFormat : 'yy-mm-dd' 
					  //, yearRange : '-66:+5'
					});


					$("#zona").change(function(){
                        var klien=$("#klien").val();
                        var zona=$("#zona").val();
                        var mobil=$("#tipe_mobil").val();
                        $.ajax({
                            url:"modul/transaksi/proses.php",
                            data:"op=harga1&zona="+zona+"&klien="+klien+"&mobil="+mobil,
                            cache:false,
							success:function(msg){
							data=msg.split("|");
							$("#harga1").val(data[1]);
                            }
                        });
                    });

					$("#zona").change(function(){
                        var jenis=$("#jenis").val();
                        var vendor=$("#vendor").val();
                        var zona=$("#zona").val();
                        var mobil=$("#tipe_mobil").val();
                        $.ajax({
                            url:"modul/transaksi/proses.php",
                            data:"op=harga2&zona="+zona+"&vendor="+vendor+"&mobil="+mobil+"&jenis="+jenis,
                            cache:false,
							success:function(msg){
							data=msg.split("|");
							$("#harga2").val(data[1]);
                            }
                        });
                    });

					$("#nopol").change(function(){
                        var klien=$("#klien").val();
                        var zona=$("#zona").val();
                        var mobil=$("#tipe_mobil").val();
                        $.ajax({
                            url:"modul/transaksi/proses.php",
                            data:"op=harga1&zona="+zona+"&klien="+klien+"&mobil="+mobil,
                            cache:false,
							success:function(msg){
							data=msg.split("|");
							$("#harga1").val(data[1]);
                            }
                        });
                    });

					$("#nopol").change(function(){
                        var jenis=$("#jenis").val();
                        var vendor=$("#vendor").val();
                        var zona=$("#zona").val();
                        var mobil=$("#tipe_mobil").val();
                        $.ajax({
                            url:"modul/transaksi/proses.php",
                            data:"op=harga2&zona="+zona+"&vendor="+vendor+"&mobil="+mobil+"&jenis="+jenis,
                            cache:false,
							success:function(msg){
							data=msg.split("|");
							$("#harga2").val(data[1]);
                            }
                        });
                    });

					$("#vendor").change(function(){
                        var vendor=$("#vendor").val();
                        //lakukan pengiriman data
                        $.ajax({
                            cache:false,
							success:function(msg){
							if (vendor == "2"){
								$('#uj').attr('disabled','disabled');
								$('#uj').val("0");
							} else {
								$('#uj').removeAttr('disabled');
							}
                            }
                        });
                    });

					
            });
		</script>
        </head>
        <body>
<?php				
			$edit=mysql_query("select * from transaksi where no_trans='$_GET[id]'");
				$data=mysql_fetch_array($edit);
				echo "<h2 class='head'>Form Pengiriman</h2>
				<table class=tabelform><form name='form1' id='form1' method='post' action='$aksi?module=transaksi&act=edit_trans'>
				<tr>
				<td>
				<table>
				<input type=hidden name='multi1'  value='$data[multidrop_klien]'/>
				<input type=hidden name='multi2' value='$data[multidrop_vendor]'/>
				<tr><td>Nama Klien</td><td>: <select name='klien' id='klien' disabled>";
					  $tampil=mysql_query("SELECT * FROM tbl_klien ORDER BY nama_klien");
					  if ($data[id_klien]==0){
						echo "<option value=0 selected></option>";
					  }   
			
					  while($w=mysql_fetch_array($tampil)){
						if ($data[id_klien]==$w[id_klien]){
						  echo "<option value=$w[id_klien] selected>$w[nama_klien]</option>";
						}
						else{
						  echo "<option value=$w[id_klien]>$w[nama_klien]</option>";
						}
					  }
				echo "</select></td></tr>";
				echo "<tr><td>No Transaksi</td><td>: <input type=text value='$data[no_trans]' name='notrans' id='notrans' readonly></td></tr>
				<tr><td>Tanggal Pengiriman</td><td>: <input type=text name='tanggal' value='$data[tanggal]' id='tanggal'/></td></tr>
				<tr><td>Jenis Pengiriman</td><td>: <select name='jenis' id='jenis'>";
					  $tampil=mysql_query("SELECT * FROM jenis_pengiriman ORDER BY id_pengiriman");
					  if ($data[id_pengiriman]==0){
						echo "<option value=0 selected></option>";
					  }   
			
					  while($w=mysql_fetch_array($tampil)){
						if ($data[id_pengiriman]==$w[id_pengiriman]){
						  echo "<option value=$w[id_pengiriman] selected>$w[jenis_pengiriman]</option>";
						}
						else{
						  echo "<option value=$w[id_pengiriman]>$w[jenis_pengiriman]</option>";
						}
					  }
				echo "</select></td></tr>";
				
				echo"<tr><td>Vendor</td><td>: <select name='vendor' id='vendor'>";
					$tampil=mysql_query("SELECT * FROM vendor ORDER BY kode_vendor");
					  if ($data[kode_vendor]==0){
						echo "<option value=0 selected></option>";
					  }   
			
					  while($w=mysql_fetch_array($tampil)){
						if ($data[kode_vendor]==$w[kode_vendor]){
						  echo "<option value=$w[kode_vendor] selected>$w[nama_vendor]</option>";
						}
						else{
						  echo "<option value=$w[kode_vendor]>$w[nama_vendor]</option>";
						}
					  }
				echo "</select></td></tr>";			
				//echo "<tr><td>No Polisi</td><td>: <input type=text name='nopol' id='nopol' value='$data[no_polisi]' /></td></tr>";	
				echo "<tr><td>No Polisi</td><td>: ";	
?>
<?php $jsArray = "var prdName = new Array();\n";
$result=mysql_query("SELECT * FROM mobil ORDER BY no_polisi");
echo '<select name="nopol" onchange="changeValue(this.value)">';
 
while ($row = mysql_fetch_array($result)) {
if ($data['no_polisi']==$row['no_polisi']) {
echo '<option value="' . $row['no_polisi'] . '" selected>' . $row['no_polisi'] . '</option>';
$jsArray .= "prdName['" . $row['no_polisi'] . "'] = {name:'" . addslashes($row['tipe_mobil']) . "'};\n";
} else {
echo '<option value="' . $row['no_polisi'] . '">' . $row['no_polisi'] . '</option>';
$jsArray .= "prdName['" . $row['no_polisi'] . "'] = {name:'" . addslashes($row['tipe_mobil']) . "'};\n";

}
}
echo '</select></td></tr>' ;
echo $makul;
?>

<?php
echo"<tr><td>Tipe Mobil</td><td>: <input type=text name='tipe_mobil' id='tipe_mobil' value='$data[tipe_mobil]' readonly/></td></tr>"; ?>
<script type="text/javascript">
<?php echo $jsArray; ?>
function changeValue(id){
document.getElementById('tipe_mobil').value = prdName[id].name;
$('#harga1').val("0");
$('#harga2').val("0");
$('#zona').val("0");
};
</script>
				
				<?php echo"<tr><td>Nama Supir</td><td>: <select name='supir' id='supir'>";
					  $tampil=mysql_query("SELECT * FROM tbl_supir ORDER BY nama_supir");
					  if ($data[id_supir]==0){
						echo "<option value=0 selected></option>";
					  }   
			
					  while($w=mysql_fetch_array($tampil)){
						if ($data[id_supir]==$w[id_supir]){
						  echo "<option value=$w[id_supir] selected>$w[nama_supir]</option>";
						}
						else{
						  echo "<option value=$w[id_supir]>$w[nama_supir]</option>";
						}
					  }
				echo "</select></td></tr>
				<tr><td>Zona Pengiriman</td><td>: <select name='zona' id='zona'>";
					  $tampil=mysql_query("SELECT * FROM zona ORDER BY zona_pengiriman");
					  if ($data[kode_zona]==0){
						echo "<option value=0 selected></option>";
					  }   
					  while($w=mysql_fetch_array($tampil)){
						if ($data[kode_zona]==$w[kode_zona]){
						  echo "<option value=$w[kode_zona] selected>$w[zona_pengiriman]</option>";
						}
						else{
						  echo "<option value=$w[kode_zona]>$w[zona_pengiriman]</option>";
						}
					  }
				echo "</select></td></tr>
				<tr><td>Harga ke Klien</td><td>: <input type=text name='harga1' id='harga1' class='nominal' value='$data[harga_klien]' readonly/></td></tr>
				<tr><td>Harga ke Vendor</td><td>: <input type=text name='harga2' id='harga2' class='nominal' value='$data[harga_vendor]' readonly/></td></tr>
				<tr><td>Uang Jalan</td><td>: <input type=text name='uj' id='uj' class='nominal' value='$data[uang_jalan]'/></td></tr>
				<tr><td>Gaji Driver</td><td>: <input type=text name='gaji' id='gaji' class='nominal' value='$data[gaji_supir]'/></td></tr>
				<tr><td>Sewa Mobil</td><td>: <input type=text name='sewa' id='sewa' class='nominal' value='$data[sewa_mobil]'/></td></tr>
				<tr><td>Keterangan</td><td>: <textarea id='ket' style='width: 30%' cols='200' rows='5' name='ket'>$data[keterangan]</textarea></td></tr>
				</table>
				</td>
				</tr>
				<tr><td><input type=submit value='Edit' id='edit' name='edit'>
				<input type=button value=Batal onclick=self.history.back()></td></tr>
				</form></table>";
				?>
</body>
</html>
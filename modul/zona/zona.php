<script type="text/javascript" charset="utf-8">
          $(document).ready(function(){
            $('#datatables').dataTable({
                         "oLanguage": {
                              "sLengthMenu": "Tampilkan _MENU_ data per halaman",
                              "sSearch": "Cari : ",
                              "sZeroRecords": "Maaf, tidak ada data yang ditemukan",
                              "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
                              "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
                              "sInfoFiltered": "(di filter dari _MAX_ total data)",
                              "oPaginate": {
                                  "sFirst": "First",
                                  "sLast": "Last",
                                  "sPrevious": "Previous",
                                  "sNext": "Next"
                           }
                      },
              "sPaginationType":"full_numbers",
              "bJQueryUI":true
            });
          })   
</script>
<?php
echo"	<script type='text/javascript'> 
	function validasi(form){
	if(form.zona_pengiriman.value==''){
	alert('Zona pengiriman harus diisi');
	form.zona_pengiriman.focus();
	return(false);
	}
	return(true);
	}
	</script>";

$aksi="modul/zona/aksi_zona.php";

switch($_GET[act]){
	default:
    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil=mysql_query("select * from zona");
	echo "<h2 class='head'>ZONA PENGIRIMAN</h2>
	<div>
	<input type=button value='Tambah Data' onclick=\"window.location.href='?module=zona&act=input';\">
	</div>
	<br/><table class='tabelmodif' id='datatables'>
	<thead>
  <tr align=center>
    <th>No</th>
    <th>Zona Pengiriman</th>
	<th>Aksi</th>
  </tr>
  </thead>";
    $no = $posisi+1;
  while($dt=mysql_fetch_array($tampil)){
  $cb=$dt[created_by];
  $co=$dt[created];
  $ub=$dt[updated_by];
  $uo=$dt[updated];
  $pesan='Dibuat Oleh : '.$cb.' \nDibuat Pada : '.$co.'\nDiubah Oleh : '.$ub.'\nDiubah Pada : '.$uo;
  echo "<tr>
    <td width=30 align=center>$no</td>
    <td>$dt[zona_pengiriman]</td>
	<td width=120><span><a href='?module=zona&act=edit&id=$dt[kode_zona]'>Edit | </a></span><span>
	<a href=\"$aksi?module=zona&act=hapus&id=$dt[kode_zona]\" onClick=\"return confirm('Yakin akan di hapus?')\">Hapus |</a></span><span>
	<a href=\"\" onClick=\"return alert('$pesan')\">View</a></span></td>
  </tr>";
  $no++;
  }
  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM zona"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    echo "</table>";
//    echo "</table><br/><p align=center>Hal $linkHalaman</p>";

	break;
	
	case "input":
	echo "<h2 class='head'>Entry Zona Pengiriman</h2>
	<form action='$aksi?module=zona&act=input' method='post' name='form' onSubmit='return validasi(this)'>
	<table class='tabelform'>
	<tr>
	<td>ZONA PENGIRIMAN</td><td>:</td><td><input class='input' name='zona_pengiriman' type='text'></td>
	</tr>
	<tr>
	<td></td><td></td><td><input type=submit value=Simpan>
	<input type=button value=Batal onclick=self.history.back()>
	</td>
	</tr>
	</table>
	</form>
	";
	break;
	
	case "edit":
	$edit=mysql_query("select * from zona where kode_zona='$_GET[id]'");
	$data=mysql_fetch_array($edit);
	echo "<h2 class='head'>Edit Zona Pengiriman</h2>
	<form action='$aksi?module=zona&act=edit' method='post' name='form' onSubmit='return validasi(this)'>
	<table class='tabelform'>
	<tr>
	<input class='input' name='kode_zona' type='hidden' value='$data[kode_zona]'>
	</tr>
	<tr>
	<td>ZONA PENGIRIMAN</td><td>:</td><td><input class='input' name='zona_pengiriman' type='text' value='$data[zona_pengiriman]'></td>
	</tr>
	<tr>
	<td></td><td></td><td><input type=submit value=Update>
	<input type=button value=Batal onclick=self.history.back()>
	</td>
	</tr>
	</table>
	</form>";
	break;
	
	case "hapus":
	
	break;
}


?>
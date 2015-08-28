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
	if(form.nama_supir.value==''){
	alert('Nama Supir harus diisi');
	form.nama_supir.focus();
	return(false);
	}
	return(true);
	}
	</script>";
	
$aksi="modul/supir/aksi_supir.php";

switch($_GET[act]){
	default:
    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil=mysql_query("select * from tbl_supir");
	echo "<h2 class='head'>DATA Supir</h2>
	<div>
	<input type=button value='Tambah Data' onclick=\"window.location.href='?module=supir&act=input';\">
	</div>
	<br/><table class='tabelmodif' id='datatables'>
	<thead>
  <tr align=center>
    <th>No</th>
    <th>Nama Supir</th>
    <th>No Telepon</th>
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
    <td>$dt[nama_supir]</td>
    <td>$dt[no_telepon]</td>
	<td width=120><span><a href='?module=supir&act=edit&id=$dt[id_supir]'>Edit | </a></span><span>
	<a href=\"$aksi?module=supir&act=hapus&id=$dt[id_supir]\" onClick=\"return confirm('Yakin akan di hapus?')\">Hapus |</a></span><span>
	<a href=\"\" onClick=\"return alert('$pesan')\">View</a></span></td>
  </tr>";
  $no++;
  }
  	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM tbl_supir"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    echo "</table>";
//    echo "</table><br/><p align=center>Hal $linkHalaman</p>";

	break;
	
	case "input":
	echo "<h2 class='head'>Entry Data Supir</h2>
	<form action='$aksi?module=supir&act=input' method='post' name='form' onSubmit='return validasi(this)'>
	<table class='tabelform'>
	<tr>
	<td>NAMA</td><td>:</td><td><input class='input' name='nama_supir' type='text'></td>
	</tr>
	<tr>
	<td>NO TELEPON</td><td>:</td><td><input class='input' name='no_telepon' type='text'></td>
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
	$edit=mysql_query("select * from tbl_supir where id_supir='$_GET[id]'");
	$data=mysql_fetch_array($edit);
	echo "<h2 class='head'>Edit Data Supir</h2>
	<form action='$aksi?module=supir&act=edit' method='post' name='form' onSubmit='return validasi(this)'>
	<table class='tabelform'>
	<tr>
	<input class='input' name='id_supir' type='hidden' value='$data[id_supir]'>
	</tr>
	<tr>
	<td>NAMA</td><td>:</td><td><input class='input' name='nama_supir' type='text' value='$data[nama_supir]'></td>
	</tr>
	<tr>
	<td>NO TELEPON</td><td>:</td><td><input class='input' name='no_telepon' type='text' value='$data[no_telepon]'></td>
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

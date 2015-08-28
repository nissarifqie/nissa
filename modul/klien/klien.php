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
	if(form.nama_klien.value==''){
	alert('Nama klien harus diisi');
	form.nama_klien.focus();
	return(false);
	}
	return(true);
	}
	</script>";
	
$aksi="modul/klien/aksi_klien.php";

switch($_GET[act]){
	default:
    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil=mysql_query("select * from tbl_klien");
	echo "<h2 class='head'>DATA KLIEN</h2>
	<div>
	<input type=button value='Tambah Data' onclick=\"window.location.href='?module=klien&act=input';\">
	</div>
	<br /><table class='tabelmodif' id='datatables'>
	<thead>
  <tr align=center>
    <th>No</th>
    <th>Nama Klien</th>
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
    <td>$dt[nama_klien]</td>
	<td width=120><span><a href='?module=klien&act=edit&id=$dt[id_klien]'>Edit | </a></span><span>
	<a href=\"$aksi?module=klien&act=hapus&id=$dt[id_klien]\" onClick=\"return confirm('Yakin akan di hapus?')\">Hapus |</a></span><span>
	<a href=\"\" onClick=\"return alert('$pesan')\">View</a></span></td>
  </tr>";
  $no++;
  }
  	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM tbl_klien"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    echo "</table>";
//    echo "</table><br/><p align=center>Hal $linkHalaman</p>";

	break;
	
	case "input":
	echo "<h2 class='head'>Entry Data Klien</h2>
	<form action='$aksi?module=klien&act=input' method='post' name='form' onSubmit='return validasi(this)'>
	<table class='tabelform'>
	<tr>
	<td>NAMA KLIEN</td><td>:</td><td><input class='input' name='nama_klien' type='text'></td>
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
	$edit=mysql_query("select * from tbl_klien where id_klien='$_GET[id]'");
	$data=mysql_fetch_array($edit);
	echo "<h2 class='head'>Edit Data Klien</h2>
	<form action='$aksi?module=klien&act=edit' method='post' name='form' onSubmit='return validasi(this)'>
	<table class='tabelform'>
	<tr>
	<input class='input' name='id_klien' type='hidden' value='$data[id_klien]'>
	</tr>
	<tr>
	<td>NAMA KLIEN</td><td>:</td><td><input class='input' name='nama_klien' type='text' value='$data[nama_klien]'></td>
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

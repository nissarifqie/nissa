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
	if(form.kode_tujuan.value==''){
	alert('Kode tujuan harus diisi');
	form.kode_tujuan.focus();
	return(false);
	}
	if(form.tujuan.value==''){
	alert('Tujuan harus diisi');
	form.tujuan.focus();
	return(false);
	}
	return(true);
	}
	</script>";

$aksi="modul/tujuan/aksi_tujuan.php";

switch($_GET[act]){
	default:
    $p      = new Paging;
    $batas  = 30;
    $posisi = $p->cariPosisi($batas);
//	$tampil=mysql_query("select  tbl_klien.nama_klien,tujuan.kode_tujuan,tujuan.tujuan, tujuan.created, tujuan.created_by, tujuan.updated, tujuan.updated_by from tujuan,tbl_klien where tbl_klien.id_klien=tujuan.id_klien order by tujuan.created ASC LIMIT $posisi,$batas");
	$tampil=mysql_query("select  tbl_klien.nama_klien,tujuan.kode_tujuan,tujuan.tujuan, tujuan.created, tujuan.created_by, tujuan.updated, tujuan.updated_by from tujuan,tbl_klien where tbl_klien.id_klien=tujuan.id_klien");
	echo "<h2 class='head'>DATA TUJUAN</h2>
	<div>
	<input type=button value='Tambah Data' onclick=\"window.location.href='?module=tujuan&act=input';\">
	</div>
	<br/><table class='tabelmodif' id='datatables'>
	<thead>
  <tr align=center>
    <th>No</th>
    <th>Kode Tujuan</th>
    <th>Tujuan Pengiriman</th>
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
    <td width=100 align=center>$dt[kode_tujuan]</td>
    <td>$dt[tujuan]</td>
    <td>$dt[nama_klien]</td>
	<td width=120><span><a href='?module=tujuan&act=edit&id=$dt[kode_tujuan]'>Edit | </a></span><span>
	<a href=\"$aksi?module=tujuan&act=hapus&id=$dt[kode_tujuan]\" onClick=\"return confirm('Yakin akan di hapus?')\">Hapus |</a></span><span>
	<a href=\"\" onClick=\"return alert('$pesan')\">View</a></span></td>
  </tr>";
  $no++;
  }
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM tujuan"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
	echo "</table>";
    //echo "</table><br/><p align=center>Hal $linkHalaman</p>";

	break;
	
	case "input":
	echo "<h2 class='head'>Entry Data Tujuan</h2>
	<form action='$aksi?module=tujuan&act=input' method='post' name='form' onSubmit='return validasi(this)'>
	<table class='tabelform'>
	<tr>
	<td>NAMA KLIEN</td><td>:</td>";
	$result = mysql_query("select * from tbl_klien order by nama_klien asc");
	echo '<td><select name="klien">';
	echo '<option> </option>';
	while ($row = mysql_fetch_array($result)) {
    echo '<option value="' . $row['id_klien'] . '">' . $row['nama_klien'] . '</option>';
	}
	echo '</select>';

	echo "</tr>
	<tr>
	<td>KODE TUJUAN</td><td>:</td><td><input class='input' name='kode_tujuan' type='text'></td>
	</tr>
	<tr>
	<td>TUJUAN</td><td>:</td><td><input class='input' name='tujuan' type='text'></td>
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
	$edit=mysql_query("select * from tujuan where kode_tujuan='$_GET[id]'");
	$data=mysql_fetch_array($edit);
	echo "<h2 class='head'>Edit Data Tujuan</h2>
	<form action='$aksi?module=tujuan&act=edit' method='post' name='form' onSubmit='return validasi(this)'>
	<table class='tabelform'>
    <tr><td>NAMA KLIEN</td><td>:</td><td><select name='klien'>";
 
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
    echo "</select></td></tr>
	<tr>
	<td>KODE TUJUAN</td><td>:</td><td><input class='input' name='kode_tujuan' type='text' value='$data[kode_tujuan]' readonly></td>
	</tr>
	<tr>
	<td>TUJUAN</td><td>:</td><td><input class='input' name='tujuan' type='text' value='$data[tujuan]'></td>
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
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

  $("#no_polisi").change(function(){
	var kd=$("#no_polisi").val();
	$.ajax({
		url:"modul/mobil/aksi_mobil.php",
		data:"op=cek&kd="+kd,
		success:function(data){
			if(data==0){
				$("#pesan").val('tidak');
			}else{
				$("#pesan").val('ada');
			}
		}
	});
});
 </script>
 
<?php
echo"	<script type='text/javascript'> 
	function validasi(form){
	if(form.pil_klien.value==''){
	alert('Nama Klien harus diisi');
	form.pil_klien.focus();
	return(false);
	}
	if(form.tipe_mobil.value==''){
	alert('Tipe Mobil harus diisi');
	form.tipe_mobil.focus();
	return(false);
	}
	if(form.no_polisi.value==''){
	alert('No Polisi harus diisi');
	form.no_polisi.focus();
	return(false);
	}	
	if(form.pesan.value=='ada'){
	alert('No Polisi sudah ada');
	form.no_polisi.focus();
	form.no_polisi.value('');
	return(false);
	}	
	return(true);
	}
	</script>";
$aksi="modul/mobil/aksi_mobil.php";

switch($_GET[act]){
	default:
    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil=mysql_query("select tbl_klien.nama_klien, mobil.tipe_mobil, mobil.no_polisi, mobil.id_mobil, mobil.created, mobil.created_by, mobil.updated, mobil.updated_by from mobil,tbl_klien where tbl_klien.id_klien=mobil.id_klien");
	echo "<h2 class='head'>DATA MOBIL</h2>
	<div>
	<input type=button value='Tambah Data' onclick=\"window.location.href='?module=mobil&act=input';\">
	</div>
	<br /><table class='tabelmodif' id='datatables'>
	<thead>
	<tr align=center>
    <th>No</th>
    <th>Tipe Mobil</th>
    <th>Nomor Polisi</th>
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
    <td>$dt[tipe_mobil]</td>
    <td>$dt[no_polisi]</td>
    <td>$dt[nama_klien]</td>
	<td width=120><span><a href='?module=mobil&act=edit&id=$dt[id_mobil]'>Edit | </a></span><span>
	<a href=\"$aksi?module=mobil&act=hapus&id=$dt[id_mobil]\" onClick=\"return confirm('Yakin akan di hapus?')\">Hapus |</a></span><span>
	<a href=\"\" onClick=\"return alert('$pesan')\">View</a></span></td>
  </tr>";
  $no++;
  }
  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM mobil"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    echo "</table>";
//    echo "</table><br/><p align=center>Hal $linkHalaman</p>";

	break;
	
	case "input":
	echo "<h2 class='head'>Entry Data Mobil</h2>
	<form action='$aksi?module=mobil&act=input' method='post' name='form' onSubmit='return validasi(this)'>
	<table class='tabelform'>
	<tr>
	<td>NAMA KLIEN</td><td>:</td>";
	$result = mysql_query("select * from tbl_klien order by id_klien asc");
	echo '<td><select name="pil_klien">';
	echo '<option> </option>';
	while ($row = mysql_fetch_array($result)) {
    echo '<option value="' . $row['id_klien'] . '">' . $row['nama_klien'] . '</option>';
	}
	echo '</select>';

	echo "</tr>
	<tr>
	<td>TIPE MOBIL</td><td>:</td><td><input class='input' name='tipe_mobil' type='text'></td>
	</tr>
	<tr>
	<td>NO POLISI</td><td>:</td><td><input class='input' name='no_polisi' id='no_polisi' type='text'><input id='pesan' type='hidden' /></td>
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
	$edit=mysql_query("select * from mobil,tbl_klien where tbl_klien.id_klien=mobil.id_klien and id_mobil='$_GET[id]'");
	$data=mysql_fetch_array($edit);
	echo "<h2 class='head'>Edit Data Mobil</h2>
	<form action='$aksi?module=mobil&act=edit' method='post' name='form' onSubmit='return validasi(this)'>
	<table class='tabelform'>
	<tr>
	<input class='input' name='id_mobil' type='hidden' value='$data[id_mobil]'>
	</tr>
    <tr><td>NAMA KLIEN</td><td>:</td><td><select name='pil_klien'>";

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
	<td>TIPE MOBIL</td><td>:</td><td><input class='input' name='tipe_mobil' type='text' value='$data[tipe_mobil]'></td>
	</tr>
	<tr>
	<td>NO POLISI</td><td>:</td><td><input class='input' name='no_polisi' id='no_polisi' type='text' value='$data[no_polisi]'><span id='pesan'></span></td>
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

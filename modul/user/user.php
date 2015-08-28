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
	
$aksi="modul/user/aksi_user.php";

switch($_GET[act]){
	default:
    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil=mysql_query("select * from user");
	echo "<h2 class='head'>DATA USER</h2>
	<div>
	<input type=button value='Tambah Data' onclick=\"window.location.href='?module=user&act=input';\">
	</div>
	<br /><table class='tabelmodif' id='datatables'>
	<thead>
  <tr align=center>
    <th>No</th>
    <th>Nama User</th>
    <th>Username</th>
    <th>Password</th>
    <th>Level</th>
  </tr>
  </thead>";
    $no = 1;
  while($dt=mysql_fetch_array($tampil)){
  echo "<tr>
    <td width=30 align=center>$no</td>
    <td>$dt[nama_user]</td>
    <td>$dt[username]</td>
    <td>...</td>
    <td>$dt[level]</td>";
//	<td width=120><span><a href='?module=klien&act=edit&id=$dt[id_klien]'>Edit | </a></span><span>	<a href=\"$aksi?module=klien&act=hapus&id=$dt[id_klien]\" onClick=\"return confirm('Yakin akan di hapus?')\">Hapus |</a></span></td>
  echo "</tr>";
  $no++;
  }
  	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM user"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    echo "</table>";
//    echo "</table><br/><p align=center>Hal $linkHalaman</p>";

	break;
	
	case "input":
	echo "<h2 class='head'>Entry Data User</h2>
	<form action='$aksi?module=user&act=input' method='post' name='form' onSubmit='return validasi(this)'>
	<table class='tabelform'>
	<tr>
	<td>NAMA USER</td><td>:</td><td><input class='input' name='nama_user' type='text'></td>
	</tr>
	<tr>
	<td>USERNAME</td><td>:</td><td><input class='input' name='username' type='text'></td>
	</tr>
	<tr>
	<td>PASSWORD</td><td>:</td><td><input class='input' name='password' type='password'></td>
	</tr>
	<tr>
	<td>CONFIRM PASSWORD</td><td>:</td><td><input class='input' name='password2' type='password'></td>
	</tr>
	<tr>
	<td>LEVEL</td><td>:</td>";
	$result = mysql_query("select * from level_user order by level asc");
	echo '<td><select name="level">';
	echo '<option> </option>';
	while ($row = mysql_fetch_array($result)) {
    echo '<option value="' . $row['level'] . '">' . $row['level_name'] . '</option>';
	}
	echo '</select>';

	echo "</tr>
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
	$edit=mysql_query("select * from user where id='$_GET[id]'");
	$data=mysql_fetch_array($edit);
	echo "<h2 class='head'>Edit Data User</h2>
	<form action='$aksi?module=user&act=edit' method='post' name='form' onSubmit='return validasi(this)'>
	<table class='tabelform'>
	<tr>
	<input class='input' name='id_klien' type='hidden' value='$data[id_klien]'>
	</tr>
	<tr>
	<td>NAMA USER</td><td>:</td><td><input class='input' name='nama_user' type='text'></td>
	</tr>
	<tr>
	<td>USERNAME</td><td>:</td><td><input class='input' name='username' type='text'></td>
	</tr>
	<tr>
	<td>PASSWORD</td><td>:</td><td><input class='input' name='password' type='password'></td>
	</tr>
	<tr>
	<td>RETYPE PASSWORD</td><td>:</td><td><input class='input' name='password' type='password'></td>
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

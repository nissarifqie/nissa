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

$aksi="modul/multidrop_vendor/aksi_multi.php";

switch($_GET[act]){
	default:
    $p      = new Paging;
    $batas  = 30;
    $posisi = $p->cariPosisi($batas);
	$tampil=mysql_query("select vendor.nama_vendor, multidrop2.id, multidrop2.tipe_mobil, multidrop2.charge_vendor, multidrop2.created, multidrop2.created_by, multidrop2.updated, multidrop2.updated_by from multidrop2,vendor where vendor.kode_vendor=multidrop2.kode_vendor");
	echo "<h2 class='head'>DATA MULTIDROP</h2>
	<div>
	<input type=button value='Tambah Data' onclick=\"window.location.href='?module=multi2&act=input';\">
	</div>
	<br/><table class='tabelmodif' id='datatables'>
	<thead>
	<tr align=center>
    <th>No</th>
    <th>Nama vendor</th>
    <th>Tipe Mobil</th>
    <th>Multidrop</th>
	<th>Aksi</th>
  </tr>
  </thead>";
    $no = $posisi+1;
  while($dt=mysql_fetch_array($tampil)){
  $harga=number_format($dt[charge_vendor],0,",",".");
  $cb=$dt[created_by];
  $co=$dt[created];
  $ub=$dt[updated_by];
  $uo=$dt[updated];
  $pesan='Dibuat Oleh : '.$cb.' \nDibuat Pada : '.$co.'\nDiubah Oleh : '.$ub.'\nDiubah Pada : '.$uo;
  echo "<tr align='center'>
    <td width=30 align=center>$no</td>
    <td>$dt[nama_vendor]</td>
    <td>$dt[tipe_mobil]</td>
    <td align=center>Rp. $harga</td>
	<td width=120><span><a href='?module=multi2&act=edit&id=$dt[id]'>Edit | </a></span><span>
	<a href=\"$aksi?module=multi2&act=hapus&id=$dt[id]\" onClick=\"return confirm('Yakin akan di hapus?')\">Hapus |</a></span><span>
	<a href=\"\" onClick=\"return alert('$pesan')\">View</a></span></td>
  </tr>";
  $no++;
  }
  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM multidrop2"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    echo "</table>";
	//echo "</table><br/><p align=center>Hal $linkHalaman</p>";
	break;
	
	case "input":
	echo "<h2 class='head'>Entry Data MUltidrop</h2>
	<form action='$aksi?module=multi2&act=input' method='post'>
	<table class='tabelform'>
	<tr>
	<td>NAMA VENDOR</td><td>:</td>";
	$result = mysql_query("select * from vendor order by kode_vendor asc");
	echo '<td><select name="pil_vendor">';
	echo '<option> </option>';
	while ($row = mysql_fetch_array($result)) {
    echo '<option value="' . $row['kode_vendor'] . '">' . $row['nama_vendor'] . '</option>';
	}
	echo '</select></td>';
	echo "<tr>
	<td>TIPE MOBIL</td><td>:</td><td><select name='tipe_mobil'>
	<option value='' selected ></option>";
	$query=mysql_query("select distinct tipe_mobil from mobil");
	while($hasil=mysql_fetch_array($query)){
	echo "<option value='$hasil[tipe_mobil]'>$hasil[tipe_mobil]</option>";
	}
	echo "</select></td>
	</tr>
	<tr>
	<td>MULTIDROP</td><td>:</td><td><input class='input' name='multidrop' type='text'></td>
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
	$edit=mysql_query("select * from multidrop2,vendor where vendor.kode_vendor=multidrop2.kode_vendor AND id='$_GET[id]'");
	$data=mysql_fetch_array($edit);
	echo "<h2 class='head'>Edit Data Multidrop</h2>
	<form action='$aksi?module=multi2&act=edit' method='post'>
	<table class='tabelform'>
	<input class='input' name='id' type='hidden' value='$data[id]'>
     <tr><td>NAMA VENDOR</td><td>:</td><td><select name='pil_vendor'>";
          $tampil=mysql_query("SELECT * FROM vendor ORDER BY nama_vendor");
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
    echo "</select></td></tr>
    <tr><td>TIPE MOBIL</td><td>:</td><td><select name='tipe_mobil'>";
 
          $tampil=mysql_query("SELECT distinct tipe_mobil FROM mobil ORDER BY tipe_mobil");
          if ($data[tipe_mobil]==0){
            echo "<option value=0 selected></option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($data[tipe_mobil]==$w[tipe_mobil]){
              echo "<option value=$w[tipe_mobil] selected>$w[tipe_mobil]</option>";
            }
            else{
              echo "<option value=$w[tipe_mobil]>$w[tipe_mobil]</option>";
            }
          }
    echo "</select></td></tr>
	<tr>
	<td>MULTIDROP</td><td>:</td><td><input class='input' name='multidrop' type='text' value='$data[charge_vendor]'></td>
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
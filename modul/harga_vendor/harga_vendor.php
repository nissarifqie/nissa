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

$aksi="modul/harga_vendor/aksi_harga_vendor.php";

switch($_GET[act]){
	default:
    $p      = new Paging;
    $batas  = 30;
    $posisi = $p->cariPosisi($batas);
	$tampil=mysql_query("select vendor.nama_vendor, zona.zona_pengiriman, harga_vendor.tipe_mobil, harga_vendor.harga_vendor ,harga_vendor.id_harga ,harga_vendor.created, harga_vendor.created_by, harga_vendor.updated, harga_vendor.updated_by from harga_vendor,zona,vendor where vendor.kode_vendor=harga_vendor.kode_vendor and zona.kode_zona=harga_vendor.kode_zona");
	echo "<h2 class='head'>DATA HARGA KE VENDOR</h2>
	<div>
	<input type=button value='Tambah Data' onclick=\"window.location.href='?module=harga2&act=input';\">
	</div>
	<br/><table class='tabelmodif' id='datatables'>
	<thead>
  <tr align=center>
    <th>No</th>
    <th>Nama Vendor</th>
    <th>Zona Pengiriman</th>
    <th>Tipe Mobil</th>
    <th>Harga</th>
	<th>Aksi</th>
  </tr>
  </thead>";
    $no = $posisi+1;
  while($dt=mysql_fetch_array($tampil)){
  $harga=number_format($dt[harga_vendor],0,",",".");
  $cb=$dt[created_by];
  $co=$dt[created];
  $ub=$dt[updated_by];
  $uo=$dt[updated];
  $pesan='Dibuat Oleh : '.$cb.' \nDibuat Pada : '.$co.'\nDiubah Oleh : '.$ub.'\nDiubah Pada : '.$uo;
  echo "<tr>
    <td width=30 align=center>$no</td>
    <td>$dt[nama_vendor]</td>
    <td>$dt[zona_pengiriman]</td>
    <td>$dt[tipe_mobil]</td>
    <td align=center>Rp. $harga</td>
	<td width=120><span><a href='?module=harga2&act=edit&id=$dt[id_harga]'>Edit | </a></span><span>
	<a href=\"$aksi?module=harga2&act=hapus&id=$dt[id_harga]\" onClick=\"return confirm('Yakin akan di hapus?')\">Hapus |</a></span><span>
	<a href=\"\" onClick=\"return alert('$pesan')\">View</a></span></td>
  </tr>";
  $no++;
  }
  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM harga_vendor"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    echo "</table>";
//    echo "</table><br/><p align=center>Hal $linkHalaman</p>";

	break;
	
	case "input":
	echo "<h2 class='head'>Entry Data Harga Vendor</h2>
	<form action='$aksi?module=harga2&act=input' method='post'>
	<table class='tabelform'>
	<tr>
	<td>NAMA VENDOR</td><td>:</td>";
	$result = mysql_query("select * from vendor order by kode_vendor asc");
	echo '<td><select name="pil_vendor">';
	echo '<option> </option>';
	while ($row = mysql_fetch_array($result)) {
    echo '<option value="' . $row['kode_vendor'] . '">' . $row['nama_vendor'] . '</option>';
	}
	echo '</select>';
	echo "</tr>
	<td>ZONA PENGIRIMAN</td><td>:</td><td><select name='pil_zona'>
	<option value='' selected ></option>";
	$query=mysql_query("select * from zona");
	while($hasil=mysql_fetch_array($query)){
	echo "<option value='$hasil[kode_zona]'>$hasil[zona_pengiriman]</option>";
	}
	echo "</select></td></tr>
	<tr>
	<td>TIPE MOBIL</td><td>:</td><td><select name='tipe_mobil'>
	<option value='' selected ></option>";
	$query=mysql_query("select distinct tipe_mobil from mobil");
	while($hasil=mysql_fetch_array($query)){
	echo "<option value='$hasil[tipe_mobil]'>$hasil[tipe_mobil]</option>";
	}
	echo "</select></td>
	</tr>
	<tr>
	<td>HARGA</td><td>:</td><td><input class='input' name='harga' type='text'></td>
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
	$edit=mysql_query("select * from harga_vendor,zona,vendor where vendor.kode_vendor=harga_vendor.kode_vendor and zona.kode_zona=harga_vendor.kode_zona and id_harga='$_GET[id]'");
	$data=mysql_fetch_array($edit);
	echo "<h2 class='head'>Edit Data Harga Vendor</h2>
	<form action='$aksi?module=harga2&act=edit' method='post'>
	<table class='tabelform'>
	<input class='input' name='id_harga' type='hidden' value='$data[id_harga]'>
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
    <tr><td>ZONA PENGIRIMAN</td><td>:</td><td><select name='pil_zona'>";
 
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
	<td>HARGA</td><td>:</td><td><input class='input' name='harga' type='text' value='$data[harga_vendor]'></td>
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
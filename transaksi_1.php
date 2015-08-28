<?php
    include('config/koneksi.php');

	@session_start();
	error_reporting(0);
	include "timeout.php";
	 if(isset($_SESSION['username1']))
	 {
		 $q = mysql_query("select nama_user,level from user where username='".$_SESSION['username1']."'");
		 while($hasil = mysql_fetch_assoc($q)){
		    $nama = $hasil['nama_user'];	
		    $level = $hasil['level'];	
		    }
		    }
	 else
	 {
		header("location:index.php");	 
	 }
?>

<html>
<head>
<link rel="shortcut icon" href="favicon.ico" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GOS LOGISTICS</title>
<link rel="stylesheet" href="css/style.css" type="text/css"  />
<script src="js/jquery-1.4.js" type="text/javascript"></script>
<script src="js/superfish.js" type="text/javascript"></script>
<script src="js/hoverIntent.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.js"></script>
<!--<script type="text/javascript" src="datepicker/ui.core.js"></script>
<script type="text/javascript" src="datepicker/ui.datepicker.js"></script>-->
			<link rel="stylesheet" href="css/style.css" type="text/css"  />
			<link type="text/css" href="datepicker/ui.core.css" rel="stylesheet" />
			<link type="text/css" href="datepicker/ui.resizable.css" rel="stylesheet" />
			<link type="text/css" href="datepicker/ui.tabs.css" rel="stylesheet" />
			<link type="text/css" href="datepicker/ui.datepicker.css" rel="stylesheet" />
			<link type="text/css" href="datepicker/ui.theme.css" rel="stylesheet" />
			<link type="text/css" href="datepicker/demos.css" rel="stylesheet" />
			<script src="js/superfish.js" type="text/javascript"></script>
			<script src="js/hoverIntent.js" type="text/javascript"></script>
			<script type="text/javascript" src="datepicker/ui.core.js"></script>
			<script type="text/javascript" src="datepicker/ui.datepicker.js"></script>
		
	<script type="text/javascript">
          $(document).ready(function(){
			   $('ul.nav').superfish();
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
			
			
/*			 $(function() { 
				$( "#coba" ).autocomplete({
				 source: "modul/transaksi/sourcedata.php", 
				   minLength:1,
				});
			});
*/	
                //mengidentifikasikan variabel yang kita gunakan
                $(function(){
                    $("#klien").load("modul/transaksi/proses.php","op=klien");
                    $("#zona").load("modul/transaksi/proses.php","op=zona");
                    $("#jenis").load("modul/transaksi/proses.php","op=jenis");
                    $("#nopol").load("modul/transaksi/proses.php","op=nopol");
                    $("#supir").load("modul/transaksi/proses.php","op=supir");
                    $("#vendor").load("modul/transaksi/proses.php","op=vendor");
					
					//untuk tanggal
					$('#tanggal').datepicker({
					  changeMonth: true,
					  changeYear: true,
					  dateFormat : 'yy-mm-dd' 
					  //, yearRange : '-66:+5'
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
					
					$("#zona").change(function(){
                        var klien=$("#klien").val();
                        var zona=$("#zona").val();
                        var mobil=$("#tipe_mobil").val();
                        $.ajax({
                            url:"modul/transaksi/proses.php",
                            data:"op=harga_klien&klien="+klien+"&zona="+zona+"&mobil"+mobil,
                            cache:false,
							success:function(msg){
							data=msg.split("|");
							$("#harga_klien").val(data[1]);
                            }
                        });
                    });
					$("#nopol").change(function(){
                        var nopol=$("#nopol").val();
                        //lakukan pengiriman data
                        $.ajax({
                            url:"modul/transaksi/proses.php",
                            data:"op=tipe&nopol="+nopol,
                            cache:false,
							success:function(msg){
							data=msg.split("|");
							$("#tipe_mobil").val(data[1]);
                            }
                        });
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
                    
					$("#tujuan").change(function(){
                        var coba=$("#tujuan").val();
                        $.ajax({
                            url:"modul/transaksi/proses.php",
                            data:"op=tujuan&tujuan="+tujuan,
                            cache:false,
							success:function(msg){
							data=msg.split("|");
							$("#nama_tujuan").val(data[0]);
							$("#kode_tujuan").val(data[1]);
                            }
                        });
                    });
		
					
								
					$("#tambah_do").click(function(){
                  
						var no_trans=$("#no_trans").val();
						var no_do=$("#no_do").val();
						var no_load=$("#no_load").val();
						var no_ship=$("#no_ship").val();
						var qty=$("#qty").val();
                        $.ajax({
                            url:"modul/transaksi/proses.php",
                            data:"op=tambah_do&no_trans="+no_trans+"&no_do="+no_do+"&no_load="+no_load+"&no_ship="+no_ship+"&qty="+qty,
                            cache:false,
                            success:function(msg){
									self.history.back();
                            }
                        });
                  });

					$("#edit_do").click(function(){
                  
						var no_do=$("#no_do").val();
						var no_load=$("#no_load").val();
						var no_ship=$("#no_ship").val();
						var qty=$("#qty").val();
                        $.ajax({
                            url:"modul/transaksi/proses.php",
                            data:"op=edit_do&no_do="+no_do+"&no_load="+no_load+"&no_ship="+no_ship+"&qty="+qty,
                            cache:false,
                            success:function(msg){
									self.history.back();
                            }
                        });
                  });
					$("#hapus").click(function(){
						var no_trans=$("#no_trans").val();
						var no_do=$("#no_do").val();
						var sewa=$("#sewa").val();
						var harga_klien=$("#harga1").val();
						var harga_vendor=$("#harga2").val();
						var uj=$("#uj").val();
						var gaji=$("#gaji").val();
						var sewa=$("#sewa").val();
						var multi=$("#multi").val();
						var multi_klien=$("#multi_klien").val();
						var multi_vendor=$("#multi_vendor").val();
                        $.ajax({
                            url:"modul/transaksi/proses.php",
                       data:"op=hapus_do&no_do="+no_do+"&no_trans="+no_trans+"&harga_klien="+harga_klien+"&harga_vendor="+harga_vendor+"&uj="+uj+"&gaji="+gaji+"&sewa="+sewa+"&multi="+multi+"&multi_klien="+multi_klien+"&multi_vendor="+multi_vendor,
                            cache:false,
                            success:function(msg){
									self.history.back();
                            }
                        });
                  });			  
            });
		</script>					






  <style type="text/css">
<!--
.style10 {
	font-family: 'IstokWebRegular';
	font-style: italic;
}
.style13 {font-family: 'TendernessRegular'}
-->
    </style>
</head>

<body>
<div id="container">
  <div id="header">
    <div align="left"><img src="images/Picture1.png" width="171" height="119"><span class="judul2 style10"><span class="style13">TRANSPORT MANAGEMENT SYSTEM</span></span> </div>
  </div>
  <div id="menu">
	<ul class="nav">
	<?php if ($level=='1') { ?>
    	<li><a class="border link linkback" href="#">Master</a>
        	<ul>
            <li><a href="modul/klien/klien.php" class="li">Klien</a></li>
            <li><a href="?module=mobil" class="li">Mobil</a></li>
            <li><a href="?module=zona" class="li">Zona</a></li>
            <li><a href="?module=tujuan" class="li">Tujuan</a></li>
            <li><a href="?module=vendor" class="li">Vendor</a></li>
            <li><a href="?module=supir" class="li">Supir</a></li>
            <li><a href="?module=harga" class="li">Charge to Client</a></li>
            <li><a href="?module=harga2" class="li">Charge to Vendor</a></li>
            <li><a href="?module=multi1" class="li">Multidrop Klien</a></li>
            <li><a href="?module=multi2" class="li">Multidrop Vendor</a></li>
            </ul>
        </li>
        <li><a class="border link linkback" href="#">Pengiriman</a>
        	<ul>
            <li><a href="?module=transaksi" class="li">Transaksi</a></li>
            </ul>
		</li>	
        <li><a class="border link linkback" href="?module=#">Laporan</a>
        	<ul>
            <li><a href="?module=laporan" class="li">Laporan Klien</a></li>
            <li><a href="?module=laporan_vendor" class="li">Laporan Vendor</a></li>
            </ul>
		</li>
        <li><a class="border link linkback" href="?module=#">Sistem Admin</a>
        	<ul>
            <li><a href="?module=user" class="li">User</a></li>
            </ul>
		</li>
		<li><a class="border link linkback" href="logout.php">Logout</a>
        </li>
        <li class="clear"></li>
	<?php } else if ($level=='2') { ?>
        <li><a class="border link linkback" href="#">Pengiriman</a>
        	<ul>
            <li><a href="?module=transaksi" class="li">Transaksi</a></li>
            </ul>
		</li>	
        <li><a class="border link linkback" href="?module=#">Laporan</a>
        	<ul>
            <li><a href="?module=laporan" class="li">Laporan Klien</a></li>
            <li><a href="?module=laporan_vendor" class="li">Laporan Vendor</a></li>
            </ul>
		</li>
		<li><a class="border link linkback" href="logout.php">Logout</a>
        </li>
        <li class="clear"></li>
	<?php } ?>
    </ul>
</div>
<div id="content">
<div class="form">
	<div align="right" class="judul1">Welcome, <?=$nama?></div>
<?php
include "config/koneksi.php";
include "config/class_paging.php";

$aksi="modul/transaksi/proses.php";
$p=isset($_GET['act'])?$_GET['act']:null;
            switch($p){
                default:
					$p      = new Paging;
					$batas  = 10;
					$posisi = $p->cariPosisi($batas);
$tampil=mysql_query("SELECT * FROM (transaksi tr LEFT JOIN trans_do td ON tr.no_trans = td.no_trans), tbl_supir s, zona z, tbl_klien k
WHERE s.id_supir=tr.id_supir AND k.id_klien=tr.id_klien AND
z.kode_zona=tr.kode_zona ");
//					$tampil=mysql_query("select * from transaksi, tbl_klien where tbl_klien.id_klien = transaksi.id_klien");
					$c=mysql_fetch_array(mysql_query("select * from transaksi"));
					echo "<h2 class='head'>DATA PENGIRIMAN</h2>
					<div>
					<input type=button value='Input Transaksi' onclick=\"window.location.href='?module=transaksi&act=transaksi';\">
					</div>
					<br/><table class='tabelmodif' id='datatables'>
					<thead>
				  	<tr align=center>
					<th>No</th>
					<th>Nama Klien</th>
					<th>No Transaksi</th>
					<th>No Load</th>
					<th>Tanggal</th>
					<th>Total</th>
					<th>Aksi</td>
				  </tr>
				  </thead>";
				  $namabulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
				  //$no = $posisi+1;
				  $no = 1;
				  $buffdo='';
			      $buffnt = 0;
				  while($dt=mysql_fetch_array($tampil)){
					if ( $dt[no_trans] == $buffnt )
					{
					$nomor = '';
					$notrans= '';
					$tanggal= '';
					$namaklien = '';
					$total = '';
					$var_aksi = '';
					}else { 
					$nomor = $no;
					$tanggal = $dt[tanggal];
					$namaklien = $dt[nama_klien];
					$notrans = $dt[no_trans];
					$total = $dt[total_klien];
					$var_aksi= "<span><a href=?module=transaksi&act=detail&id=$dt[no_trans]>Detail | </a></span><span><a href='?module=edit_transaksi&id=$dt[no_trans]'>Edit | </a></span><span><a href=$aksi?module=transaksi&act=hapus&id=$dt[no_trans] onClick=\"return confirm('Yakin transaksi No $dt[no_trans] akan di hapus?')\">Hapus | </a></span><span><a href=\"\" onClick=\"return alert('$pesan')\">View</a></span>";
					$buffdo = $dt[no_do];
					$buffnt = $dt[no_trans];
					$no++;
					}
					$harga=number_format($total,0,",",".");
					$cb=$c[created_by];
					$co=$c[created];
					$ub=$c[updated_by];
					$uo=$c[updated];
				  $pesan='Dibuat Oleh : '.$cb.' \nDibuat Pada : '.$co.'\nDiubah Oleh : '.$ub.'\nDiubah Pada : '.$uo;
				  echo "<tr>
					<td width=30 align=center></td>
					<td>$namaklien</td>
					<td width=100 align=center>$notrans</td>
					<td>$dt[no_load]</td>
					<td width=auto align=center>";
					   list($thn,$bln,$tgl)=explode('-',$tanggal);
   						echo $tgl.' '.$namabulan[(int)$bln].' '.$thn;
					echo "</td>
				    <td align=center>$harga</td>
		            <td width=150>$var_aksi</td>
				  </tr>";
				  $no++;
				  }
				  	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM transaksi"));
					$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
					$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
					echo "</table>";
//					echo "</table><br/><p align=center>Hal $linkHalaman</p>";
				break;

				case "transaksi":
				echo "<h2 class='head'>Form Pengiriman</h2>
				<table class=formtrans><form name='form1' id='form1' method='post' action='$aksi?module=transaksi&act=tambah_trans'>
				<tr>
				<td>
				<table class=tabelform>
				<tr><td>Nama Klien</td><td>: <select name='klien' id='klien'></select></td></tr>";
					$data=mysql_query("select max(no_trans) as nomor from transaksi");
					while($r=mysql_fetch_array($data)){
						if ($r['nomor'] == 0){
						$nomor2 = "1";
						} else {
						$nomor1 = $r[nomor];
						$nomor2 = $nomor1+1;
						}
					}
				echo "<tr><td>No Transaksi</td><td>: <input type=text value='$nomor2' name='notrans' id='notrans' readonly></td></tr>
				<tr><td>Tanggal Pengiriman</td><td>: <input type=text name='tanggal' id='tanggal' placeholder='YYYY-MM-DD'/></td></tr>
				<tr><td>Jenis Pengiriman</td><td>: <select name='jenis' id='jenis'></td></tr>
				<tr><td>Vendor</td><td>: <select name='vendor' id='vendor'></select></td></tr>
				<tr><td>No Polisi</td><td>: <select name='nopol' id='nopol'></select></td></tr>
				<tr><td>Tipe Mobil</td><td>: <input type=text name='tipe_mobil' id='tipe_mobil' readonly></select></td></tr>
				<tr><td>Nama Supir</td><td>: <select name='supir' id='supir'></select></td></tr>
				<tr><td>Zona Pengiriman</td><td>: <select name='zona' id='zona'></select></td></tr>
				<tr><td>Harga ke Klien</td><td>: <input type=text name='harga1' id='harga1' class='nominal' readonly/></td></tr>
				<tr><td>Harga ke Vendor</td><td>: <input type=text name='harga2' id='harga2' class='nominal' readonly/></td></tr>
				<tr><td>Uang Jalan</td><td>: <input type=text name='uj' id='uj' class='nominal'/></td></tr>
				<tr><td>Gaji Driver</td><td>: <input type=text name='gaji' id='gaji' class='nominal'/></td></tr>
				<tr><td>Sewa Mobil</td><td>: <input type=text name='sewa' id='sewa' class='nominal'/></td></tr>
				<tr><td>Keterangan</td><td>: <textarea id='ket' style='width: 30%' cols='200' rows='3' name='ket'></textarea></td></tr>
				</table>
				</td>
				</tr>
				<tr><td><input type=submit value='Simpan'  id='simpan' name='simpan'>
				<input type=button value=Batal onclick=self.history.back()></td></tr>
				</form></table>";
				break;
						
			case "detail":
			$namabulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
			$tampil = mysql_query("SELECT * FROM transaksi,zona,tbl_klien,tbl_supir,jenis_pengiriman where tbl_klien.id_klien=transaksi.id_klien and zona.kode_zona=transaksi.kode_zona and tbl_supir.id_supir=transaksi.id_supir and jenis_pengiriman.id_pengiriman=transaksi.id_pengiriman and no_trans='$_GET[id]'");
			$tampil_vendor = mysql_query("SELECT vendor.nama_vendor FROM transaksi,vendor WHERE vendor.kode_vendor=transaksi.kode_vendor and  no_trans='$_GET[id]'");
			$r    = mysql_fetch_array($tampil);
			$q    = mysql_fetch_array($tampil_vendor);
			$nilai1=number_format($r[harga_klien],0,",",".");
			$nilai2=number_format($r[harga_vendor],0,",",".");
			$nilai3=number_format($r[multidrop_klien],0,",",".");
			$nilai4=number_format($r[multidrop_vendor],0,",",".");
			$nilai5=number_format($r[total_klien],0,",",".");
			$nilai6=number_format($r[total_vendor],0,",",".");
			$nilai7=number_format($r[sewa_mobil],0,",",".");
			$nilai8=number_format($r[margin],0,",",".");
			$nilai9=number_format($r[uang_jalan],0,",",".");
			$nilai10=number_format($r[gaji_supir],0,",",".");
			echo "<h2 class=head>Detail Transaksi Pengiriman</h2>
			  <input type=hidden name=id value=$r[no_trans]>
			<table class=detailtrans>
			<tr><td width='200'>Klien</td><td> : $r[nama_klien]</td><td class='judul1' colspan=2>CHARGE TO CLIENT</td></tr>
			<tr><td>No. Transaksi</td><td> : $r[no_trans]</td><td>Harga ke Klien</td><td> : $nilai1</td></tr>
			<tr><td>Tanggal Pengiriman</td><td> : ";
			list($thn,$bln,$tgl)=explode('-',$r['tanggal']);
			echo $tgl.' '.$namabulan[(int)$bln].' '.$thn;
			echo"</td><td>Multidrop</td><td> : $nilai3</td></tr>
			<tr><td>Jenis Pengirman</td><td> : $r[jenis_pengiriman]</td><td>TOTAL</td><td> : $nilai5</td></tr>";
			echo "<tr><td>Vendor</td><td> : $q[nama_vendor]</td><td colspan=2></td></tr>";
			echo "<tr><td>Nomor Polisi</td><td> : $r[no_polisi]</td><td colspan=2>CHARGE TO VENDOR</td></tr>
			<tr><td>Tipe Mobil</td><td> : $r[tipe_mobil]</td><td>Harga ke Vendor</td><td> : $nilai2</td></tr>
			<tr><td>Nama Supir</td><td> : $r[nama_supir]</td><td>Multidrop</td><td> : $nilai4</td></tr>
			<tr><td>Zona Pengiriman</td><td> : $r[zona_pengiriman]</td><td>Uang Jalan</td><td> : $nilai9</td></tr>
			<tr><td rowspan=2>Keterangan</td><td rowspan=2>: $r[keterangan]</td><td>Gaji Driver</td><td> : $nilai10</td></tr>
			<tr><td>Sewa Mobil</td><td> : $nilai7</td></tr>
			<tr><td colspan=2>&nbsp;</td><td>TOTAL</td><td> : $nilai6</td></tr>
			<tr><td colspan=2>&nbsp;</td><td>Margin</td><td> : $nilai8</td></tr>
			<tr></tr></table>";		   
			$q = mysql_query("SELECT * FROM trans_do where no_trans='$_GET[id]'");
			echo"<table class=tabelmodif>  
			<tr><th width=50>No</th><th>No DO</th><th>No Load</th><th>No Shipment</th><th>Kuantiti</th><th>Jumlah Tujuan</th><th>Aksi</th></tr>";
			$no=1;
			while($s= mysql_fetch_array($q)){		  
			$q2 = mysql_fetch_array(mysql_query("SELECT count(tujuan) as jumlah FROM trans_tujuan where no_do='$s[no_do]'"));
			$tot = mysql_fetch_array(mysql_query("SELECT count(tujuan) as jumlah FROM trans_tujuan where no_trans='$s[no_trans]'"));
			$multi = mysql_fetch_array(mysql_query("SELECT sum(multi) as jumlah FROM trans_do where no_trans='$s[no_trans]'"));
			$multi_all = $tot[jumlah]-3;
		if($multi_all<0){
		$jumlah_multi=0;
		} else {
		$jumlah_multi=$multi_all;
		}
			echo"
			<tr><td>$no</td>
			<td>$s[no_do]</td>
			<td>$s[no_load]</td>
			<td>$s[no_shipment]</td>
			<td>$s[kuantiti]</td>
			<td>$q2[jumlah] Titik</td>
			<td width=100><a href=?module=detail_do&id=$s[no_do]><b>Detail | </b></a>
";
//			<td width=100><a href=?module=transaksi&act=detail_do&id=$s[no_do]><b>Detail | </b></a>
echo"			<a href=?module=transaksi&act=edit_do&id=$s[no_do]><b>Edit | </b></a><a href=?module=transaksi&act=hapus_do&id=$s[no_do]><b>Hapus</b></a>";	
			$no++;	  
			}		
		$multi1= mysql_fetch_array(mysql_query("select * from multidrop1 where tipe_mobil='$r[tipe_mobil]' and id_klien='$r[id_klien]'"));				
		$multi2=mysql_fetch_array(mysql_query("select * from multidrop2 where tipe_mobil='$r[tipe_mobil]' and kode_vendor=$r[kode_vendor]"));
			
			echo"<tr><td colspan=5 align=right><b>Total Pengiriman : </b></td><td colspan=2><b>$tot[jumlah] Titik</b></td></tr><tr><td colspan=5 align=right><b>Multidrop : </b></td><td colspan=2><b>$jumlah_multi</b></td></tr><tr><td colspan='7' align='right'><input type=button onclick=\"window.location.href='?module=transaksi&act=tambah_do&id=$r[no_trans]';\" value='Tambah DO'></td>
			  </table>
			<br/><input type=button value='Kembali' onclick=\"window.location.href='?module=transaksi';\"></td></tr>
			";	
			break;
		
		
		  case "tambah_do" :
		  $trans=$_GET[id];
		  $q = mysql_fetch_array(mysql_query("SELECT sum(multi) as total FROM trans_do where no_trans='$_GET[id]'"));
		  echo "<h2 class=head>Detail Transaksi Pengiriman</h2>
		  		<table class=tabelform><form>
                <span id='status'></span>
    			<tr><td>No Transaksi</td><td>: <input type='text' name='no_trans' id='no_trans' value='$trans' readonly></td></tr>
    			<tr><td>No DO</td><td>: <input type='text' name='no_do' id='no_do'></td></tr>
				<tr><td>No Load</td><td>: <input type='text' name='no_load' id='no_load' /></td></tr>
				<tr><td>No Shipment</td><td>: <input type='text' name='no_ship' id='no_ship' /></td></tr>
				<tr><td>Kuantiti</td><td>: <input type='text' name='qty' id='qty'/></td></tr>
				<tr><td colspan=2>&nbsp;</td></tr>
				<tr><td align=right colspan=2><input type='button' value='Tambah DO'  id='tambah_do' name='tambah'> <input type=button value=Kembali onclick=self.history.back()></td></tr></td></tr>
				</form></table> 
		  
		  "; 
		  break;
		
		case "edit_do" :
		$edit=mysql_query("select * from trans_do where no_do='$_GET[id]'");
		$data=mysql_fetch_array($edit);
		echo "<h2 class=head>Detail Transaksi Pengiriman</h2>
		<table class=tabelform><form>
		<span id='status'></span>
		<tr><td>No Transaksi</td><td>: <input type='text' name='no_trans' id='no_trans' value='$data[no_trans]' readonly></td></tr>
		<tr><td>No DO</td><td>: <input type='text' name='no_do' id='no_do' value='$data[no_do]' readonly></td></tr>
		<tr><td>No Load</td><td>: <input type='text' name='no_load' id='no_load' value='$data[no_load]' /></td></tr>
		<tr><td>No Shipment</td><td>: <input type='text' name='no_ship' id='no_ship' value='$data[no_shipment]' /></td></tr>
		<tr><td>Kuantiti</td><td>: <input type='text' name='qty' id='qty' value='$data[kuantiti]' /></td></tr>
		<tr><td colspan=2>&nbsp;</td></tr>
		<tr><td align=right colspan=2><input type='button' value='Edit'  id='edit_do' name='edit_do'> <input type=button value=Kembali onclick=self.history.back()></td></tr></td></tr>
		</form></table> 
		
		"; 
		break;
		
		
		case "hapus_do" :
		$query1 = mysql_query("SELECT transaksi.sewa_mobil,transaksi.uang_jalan,transaksi.gaji_supir,transaksi.harga_klien,transaksi.harga_vendor,transaksi.kode_vendor,transaksi.id_klien,transaksi.tipe_mobil,zona.zona_pengiriman,trans_do.no_trans,trans_do.no_do FROM transaksi, trans_do,zona WHERE zona.kode_zona=transaksi.kode_zona AND transaksi.no_trans = trans_do.no_trans AND no_do = '$_GET[id]'");
		$q=mysql_fetch_array($query1);
		$edit=mysql_query("select * from trans_do where no_do='$_GET[id]'");
		$edit2=mysql_query("select count(*) as total, kode_tujuan, tujuan from trans_tujuan where no_do='$_GET[id]'");
		$data=mysql_fetch_array($edit);
		$data2=mysql_fetch_array($edit2);
		$multi1= mysql_fetch_array(mysql_query("select * from multidrop1 where tipe_mobil='$q[tipe_mobil]' and id_klien='$q[id_klien]'"));				
		$multi2=mysql_fetch_array(mysql_query("select * from multidrop2 where tipe_mobil='$q[tipe_mobil]' and kode_vendor=$q[kode_vendor]"));
		$multi = mysql_fetch_array(mysql_query("SELECT sum(multi) as jumlah FROM trans_do where no_trans='$q[no_trans]'"));
		echo "<h2 class=head>Detail Transaksi Pengiriman</h2>
		<table class=tabelform><form method='post'>
		<tr><td>No Transaksi</td><td>: <input type='text' name='no_trans' id='no_trans' value='$data[no_trans]' readonly></td></tr>
		<tr><td>No DO</td><td>: <input type='text' name='no_do' id='no_do' value='$data[no_do]' readonly></td></tr>
		<tr><td>No Load</td><td>: <input type='text' name='no_load' id='no_load' value='$data[no_load]' readonly/></td></tr>
		<tr><td>No Shipment</td><td>: <input type='text' name='no_ship' id='no_ship' value='$data[no_shipment]' readonly/></td></tr>
		<tr><td>Kuantiti</td><td>: <input type='text' name='qty' id='qty' value='$data[kuantiti]' readonly/></td></tr>
		<tr><td>Tujuan</td><td>: <input type='text' name='qty' id='qty' value='$data2[total] Titik' readonly/></td></tr>
		<tr><td>Multidrop</td><td>: <input type='text' name='multi' id='multi' value='$data[multi]' readonly/></td></tr>
		<input type=hidden name='harga1' id='harga1' value='$q[harga_klien]'>
		<input type=hidden name='harga2' id='harga2' value='$q[harga_vendor]'>
		<input type=hidden name='uj' id='uj' value='$q[uang_jalan]'>
		<input type=hidden name='gaji' id='gaji' value='$q[gaji_supir]'>
		<input type=hidden name='sewa' id='sewa' value='$q[sewa_mobil]'>
		<input type=hidden name='multi' id='multi' value='$multi[jumlah]'>
		<input type=hidden name='multi_klien' id='multi_klien' value='$multi1[charge_klien]'>
		<input type=hidden name='multi_vendor' id='multi_vendor' value='$multi2[charge_vendor]'>
		";
		echo "<tr><td colspan=2>&nbsp;</td></tr>
		<tr><td align=right colspan=2><input type='button' value='Hapus'  id='hapus' name='hapus'> <input type=button value=Kembali onclick=self.history.back()></td></tr></td></tr>
		</form></table> 
		
		"; 
		break;
		
		
/*		case "detail_do":
		$query1 = mysql_query("SELECT transaksi.no_trans, transaksi.harga_klien,transaksi.harga_vendor,transaksi.uang_jalan,transaksi.gaji_supir,transaksi.sewa_mobil,transaksi.total_klien,transaksi.total_vendor,transaksi.kode_vendor,transaksi.id_klien,transaksi.tipe_mobil,zona.zona_pengiriman,trans_do.no_trans,trans_do.no_do FROM transaksi, trans_do,zona WHERE zona.kode_zona=transaksi.kode_zona AND transaksi.no_trans = trans_do.no_trans AND no_do = '$_GET[id]'");
		
		$q=mysql_fetch_array($query1);
		$multi1= mysql_fetch_array(mysql_query("select * from multidrop1 where tipe_mobil='$q[tipe_mobil]' and id_klien='$q[id_klien]'"));				
		$multi2=mysql_fetch_array(mysql_query("select * from multidrop2 where tipe_mobil='$q[tipe_mobil]' and kode_vendor=$q[kode_vendor]"));
		$multi = mysql_fetch_array(mysql_query("SELECT sum(multi) as jumlah FROM trans_do where no_trans='$q[no_trans]'"));
		$query = mysql_query("SELECT kode_tujuan, tujuan from tujuan order by tujuan");
		echo "<h2 class=head>Tujuan Pengiriman</h2>
		<table class='detailtrans'><form method='POST'>
		<tr><td>No Transaksi</td><td>: $q[no_trans]</td>
		<input type=hidden name='harga1' value='$q[harga_klien]'>
		<input type=hidden name='harga2' value='$q[harga_vendor]'>
		<input type=hidden name='uj' value='$q[uang_jalan]'>
		<input type=hidden name='gaji' value='$q[gaji_supir]'>
		<input type=hidden name='sewa' value='$q[sewa_mobil]'>
		<input type=hidden name='notrans' value='$q[no_trans]'>
		<input type=hidden name='multi' value='$multi[jumlah]'>
		<input type=hidden name='multi_klien' value='$multi1[charga_klien]'>
		<input type=hidden name='multi_vendor' value='$multi2[charga_vendor]'>
		 </tr>
		<tr><td>No DO</td><td>: <input type='text' id='no_do' name='no_do' value='$_GET[id]' readonly></td></tr>
		<tr><td>Zona Pengiriman</td><td>: $q[zona_pengiriman]</td><tr><td>TUJUAN</td><td>: <input type='text' id='coba' class='input' name='coba'></td></tr>";
		echo "<tr><td>Tujuan</td><td>: <select name='tujuan' id='tujuan'>";
		echo "<option value=0></option>";
		while ($r=mysql_fetch_array($query)) {
		echo "<option value='$r[kode_tujuan]'>$r[tujuan]</option>";
		}
		echo"</select></td></tr>";
		echo "<tr><td>Kode Tujuan</td><td>: <input type='text' id='kode_tujuan' name='kode_tujuan' readonly><input type='hidden' id='nama_tujuan' name='nama_tujuan'></td>
		<tr><td>&nbsp;</td><td><input type=submit id='tambah_tujuan' name='tambah_tujuan' value='Tambah Tujuan'> <input type=submit id='hapus_tujuan' name='hapus_tujuan' value='Hapus Tujuan'></td></tr>
		</table>";
		$notrans = $_POST['notrans'];
		$no_do = $_POST['no_do'];
//		$coba = $_POST['coba'];
		$kode = $_POST['tujuan'];
		$nama1 = $_POST['nama_tujuan'];
		$harga1 = $_POST['harga1'];
		$harga2 = $_POST['harga2'];
		$uj = $_POST['uj'];
		$gaji = $_POST['gaji'];
		$sewa = $_POST['sewa'];
		$multi1 = ($_POST['multi_klien'])*($_POST['multi']);
		$multi2 = ($_POST['multi_vendor'])*($_POST['multi']);
		$total1=$harga1+$multi1;
		$total2=$harga2+$sewa+$uj+$gaji+$multi2;
		$margin=$total1-$total2;
		if (isset($_POST['tambah_tujuan']) AND !empty($nama1) AND !empty($kode) AND !empty($no_do) ) {
//		if (isset($_POST['tambah_tujuan']) ) {
//		$tambah = mysql_query("insert into trans_tujuan (no_trans,no_do,kode_tujuan) values ('$notrans','$no_do','$coba')");
		$tambah = mysql_query("insert into trans_tujuan (no_trans,no_do,kode_tujuan,tujuan) values ('$notrans','$no_do','$kode','$nama1')");
		} elseif (isset($_POST['hapus_tujuan'])) {
		$hapus = mysql_query("delete from trans_tujuan where no_do='$no_do'");
		$update=mysql_query("update trans_do set multi='0' where no_trans='$notrans' and no_do=$no_do");
		$update1=mysql_query("update transaksi set multidrop_klien='multi1', total_klien='$total1', multidrop_vendor='multi2', total_vendor='$total2', margin='$margin' where no_trans='$q[no_trans]'");
		}
		$data=mysql_query("select * from trans_tujuan where no_do='$_GET[id]'");
		echo"<table class='tabelmodif1' id='tbl_tujuan'>
		<thead>
		<th>No</th>
		<th>Kode Tujuan</th>
		<th>Tujuan</th>";
//		<th>Aksi</th>
		echo"</thead>";
		$no=1;
		$total=mysql_fetch_array(mysql_query("select count(*) as total from trans_tujuan where no_do='$_GET[id]'"));
		while($r=mysql_fetch_array($data)){
			echo "<tr>
					<td>$no</td>
					<td>$r[kode_tujuan]</td>
					<td>$r[tujuan]</td>"; 
					 //<td><a href=$aksi?module=transaksi&act=hapus_tujuan&id=$r[kode_tujuan]>Hapus</a></td>
					echo"</tr>";
					$no++;
    	}
		$a = $total['total'];
		$b = $a - 3;
		if($b<0){
		$c = 0;
		} else {
		$c = $b;
		}
		echo"<tr><td colspan=4>Total : $total[total] Titik</td></tr>
		<tr><td colspan=4>Multidrop : $c</td></tr>";
		//perhitungan multidrop
		$update=mysql_query("update trans_do set multi='$c' where no_do='$_GET[id]' AND no_trans='$q[no_trans]'");
		$multi = mysql_fetch_array(mysql_query("SELECT sum(multi) as jumlah FROM trans_do where no_trans='$q[no_trans]'"));
		$multi1= mysql_fetch_array(mysql_query("select * from multidrop1 where tipe_mobil='$q[tipe_mobil]' and id_klien='$q[id_klien]'"));
		$multi2=mysql_fetch_array(mysql_query("select * from multidrop2 where tipe_mobil='$q[tipe_mobil]' and kode_vendor=$q[kode_vendor]"));
		$charge_klien=(($multi['jumlah'])*($multi1['charge_klien']));
		$charge_vendor=(($multi['jumlah'])*($multi2['charge_vendor']));
		$total1=(($q['harga_klien'])+($charge_klien));
		$total2=(($q['harga_vendor'])+($q['uang_jalan'])+($q['gaji_supir'])+($q['sewa_mobil'])+($charge_vendor));
		$margin=$total1-$total2;
		$update=mysql_query("update transaksi set multidrop_klien='$charge_klien', total_klien='$total1', multidrop_vendor='$charge_vendor', total_vendor='$total2', margin='$margin' where no_trans='$q[no_trans]'");
		echo"</form></table><br/><input type=button value=Kembali onclick=\"window.location.href='?module=transaksi&act=detail&id=$q[no_trans]';\"></td></tr>
		";	
		break;
		*/
            }			
            ?>
	</div>
</div>
<div id="footer"> Copyright &copy;  <script language="JavaScript" type="text/javascript">
    now = new Date
    theYear = now.getYear()
    if (theYear < 1900)
    theYear = theYear + 1900
    document.write(theYear)
</script> 
</div>
</body>
</html>

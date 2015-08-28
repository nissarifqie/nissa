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
			<link rel="stylesheet" href="js/jquery-ui.css" type="text/css"  />
			<link type="text/css" href="datepicker/ui.core.css" rel="stylesheet" />
			<link type="text/css" href="datepicker/ui.resizable.css" rel="stylesheet" />
			<link type="text/css" href="datepicker/ui.tabs.css" rel="stylesheet" />
			<link type="text/css" href="datepicker/ui.datepicker.css" rel="stylesheet" />
			<link type="text/css" href="datepicker/ui.theme.css" rel="stylesheet" />
<!--<script type="text/javascript" src="datepicker/ui.core.js"></script>
<script type="text/javascript" src="datepicker/ui.datepicker.js"></script>-->
		
	<script type="text/javascript">
      $(document).ready(function(){
			   $('ul.nav').superfish();
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
            <li><a href="?module=klien" class="li">Klien</a></li>
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
            <li><a href="?module=transaksi&act=transaksi" class="li">Tambah Transaksi</a></li>
            </ul>
		</li>	
        <li><a class="border link linkback" href="?module=#">Laporan</a>
        	<ul>
            <li><a href="?module=laporan" class="li">Laporan Klien</a></li>
            <li><a href="?module=laporan_vendor" class="li">Laporan Vendor</a></li>
            <li><a href="?module=laporan_margin" class="li">Laporan Gabungan</a></li>
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
	<?php include "data.php"; ?>
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

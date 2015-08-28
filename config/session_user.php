 <?php   include("koneksi.php");
	@session_start();
	error_reporting(0);
	if(isset($_SESSION['username']))
	{
		$q = mysql_query("select nama_user from user where username='".$_SESSION['username']."'");
		while($hasil = mysql_fetch_array($q)){
		   $nama = $hasil['nama_user'];	
		   }
		   }		   
?>
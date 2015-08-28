<?php
    include('config/koneksi.php');

	@session_start();
	error_reporting(0);
	include "timeout.php";
	 if(isset($_SESSION['username1'])) {
		header("location:media.php");
		} else {

?>
<html>
<head>
	<meta name="viewport" content="width=device-width">
	<meta name="description" content="Responsive Menu with SelectNav JS by Mkhuda">
<title>GOS LOGISTICS</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/style_login.css">

<link rel="shortcut icon" href="favicon.ico" />

<script type="text/javascript">
function validasi(form){
if (form.username.value == ""){
alert("Anda belum mengisikan Username");
form.username.focus();
return (false);
}
     
if (form.password.value == ""){
alert("Anda belum mengisikan Password");
form.password.focus();
return (false);
}
return (true);
}
</script>	
</head>	
<body>
	<div id="logo" class="logo"><img src="images/Picture1.png" width="171" height="119"></div>	
	<div id="container">
	<form method="post" action="login.php" onSubmit="return validasi(this)">
	<label class="username">Username</label><br>
	<input class="input" type="name" name="username" placeholder="Masukkan Username"><br>
	<label class="password">Password</label><br>    	
	<input class="input" type="password" name="pass" placeholder="Masukkan Password"><br>
	<input type="submit" name="submit" id="submit" value="LOGIN"></input>
</form>
</div>
</body>
</html>
<?php 	 }
?>
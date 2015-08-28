<?php
//connect to your database
include "../../config/koneksi.php";

//harus selalu gunakan variabel term saat memakai autocomplete,
//jika variable term tidak bisa, gunakan variabel q
$term = trim(strip_tags($_GET['term']));
 
$qstring = "SELECT * FROM tujuan WHERE tujuan LIKE '".$term."%' OR kode_tujuan LIKE '".$term."%'";
//query database untuk mengecek tabel Country
$result = mysql_query($qstring);
 
while ($row = mysql_fetch_array($result))
{
//    $row['value']=htmlentities(stripslashes($row['tujuan']));
//    $row['id']=(int)$row['kode_tujuan'];
//buat array yang nantinya akan di konversi ke json
//    $row_set[] = $row;
      $arrData[] = array("value" => $row["kode_tujuan"], 
                         "label" => $row["kode_tujuan"]." - ".$row["tujuan"]."");

}
//data hasil query yang dikirim kembali dalam format json
echo json_encode($arrData);
?>

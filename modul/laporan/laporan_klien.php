<?php
// Define relative path from this script to mPDF
$nama_dokumen='PDF With MPDF'; //Beri nama file PDF hasil.
define('_MPDF_PATH','MPDF60/');
include(_MPDF_PATH . "mpdf.php");
$mpdf=new mPDF('en-GB');
$mpdf=new mPDF('utf-8', 'Legal-L'); // Create new mPDF Document 
//Beginning Buffer to save PHP variables and HTML tags
ob_start();
?>
<?php
include "../../config/koneksi.php";
include "../../config/class_paging.php";
?>
<?php
	include "../../modul/laporan/tampil.php";
?>
</table>
<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>

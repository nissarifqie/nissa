<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GOS LOGISTICS</title>
<style type="text/css">
</style> 
<script type="text/javascript" charset="utf-8">
          $(document).ready(function(){
            $('#datatables').dataTable({
              "sPaginationType":"full_numbers",
              "bJQueryUI":true
            });
          })   
        </script>
</head>
 
<body>
<table id="datatables" class="tabelmodif">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Tujuan</th>
                        <th>Tujuan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    mysql_connect("localhost","root","");
                    mysql_select_db("goslog");
                              $sql = mysql_query("SELECT * FROM tujuan ORDER BY kode_tujuan");
                              $no = 1;
                    while ($mhs = mysql_fetch_array($sql)) {
                      echo "<tr>
                            <td width=40>$no</td>
                            <td>$mhs[kode_tujuan]</td>
                            <td>$mhs[tujuan]</td>
                            </tr>";
                      $no++;
                    }                   
                    ?>
                </tbody>
            </table>
</body>
</html>
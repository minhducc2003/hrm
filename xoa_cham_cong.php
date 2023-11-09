<?php
require_once('Connections/Myconnection.php');
//ket noi sql
$ID=$_GET['catID'];
mysqli_select_db($Myconnection, $database_Myconnection);
$query= "DELETE from tlb_chamcong WHERE id='" . $ID . "'";
mysqli_query($Myconnection,$query);
echo "<meta http-equiv='refresh' content='0;URL=index.php?require=ngay_cong.php&title=Ngày công'>";
?>
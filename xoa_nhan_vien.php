<?php
require_once('Connections/Myconnection.php');
//ket noi sql
$MNV=$_GET['catID'];
mysqli_select_db($Myconnection, $database_Myconnection);
$query= "DELETE from tlb_nhanvien WHERE ma_nhan_vien='" . $MNV . "'";
$query2= "DELETE from tlb_congviec WHERE ma_nhan_vien='" . $MNV . "'";
mysqli_query($Myconnection,$query);
mysqli_query($Myconnection,$query2);
echo "<meta http-equiv='refresh' content='0;URL=index.php?require=danh_sach_nhan_vien.php&title=Danh sách nhân viên'>";
?>
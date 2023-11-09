<?php
require_once('Connections/Myconnection.php');
// tim phan quyen
$quyen = "SELECT quyen_them, quyen_sua, quyen_xoa FROM tlb_nguoidung WHERE ten_dang_nhap = '".$_SESSION['user_name']."'";
$resultQuyen = mysqli_query($Myconnection, $quyen);
$rowQuyen = mysqli_fetch_array($resultQuyen);
$quyenThem = $rowQuyen['quyen_them'];
$quyenSua = $rowQuyen['quyen_sua'];
$quyenXoa = $rowQuyen['quyen_xoa'];
?>
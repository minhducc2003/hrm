<?php require_once('include/function.php');
	if ( !isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
		header('Location: dang_nhap.php');
		exit;
	}
	else{
		$url = "index.php?require=danh_sach_nhan_vien.php&title=Danh sách nhân viên";
		location($url);
	}
?>
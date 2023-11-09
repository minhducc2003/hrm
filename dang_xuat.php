<?php
require_once('include/function.php');
if (isset($_SESSION['logged-in'])) {
	unset($_SESSION['logged-in']);
}
header('Location: dang_nhap.php');
?>
<?php
$hostname_Myconnection = "localhost";
$database_Myconnection = "thuctap_nhansu";
$username_Myconnection = "root";
$password_Myconnection = "";
$Myconnection = mysqli_connect($hostname_Myconnection, $username_Myconnection,'',$database_Myconnection);
mysqli_set_charset($Myconnection, 'utf8');
?>
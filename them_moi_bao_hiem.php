<?php
$ma_nv = $_GET['catID'];
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  //$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tlb_baohiem (ma_nhan_vien, so_bhxh, ngay_cap_bhxh, noi_cap_bhxh, so_bhyt, ngay_cap_bhyt, noi_cap_bhyt) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ma_nhan_vien'], "text"),
                       GetSQLValueString($_POST['so_bhxh'], "text"),
                       GetSQLValueString($_POST['ngay_cap_bhxh'], "date"),
                       GetSQLValueString($_POST['noi_cap_bhxh'], "text"),
                       GetSQLValueString($_POST['so_bhyt'], "text"),
                       GetSQLValueString($_POST['ngay_cap_bhyt'], "date"),
                       GetSQLValueString($_POST['noi_cap_bhyt'], "text"));

  mysqli_select_db($Myconnection, $database_Myconnection);
  $Result1 = mysqli_query($Myconnection, $insertSQL);

  $insertGoTo = "them_moi_bao_hiem.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
	sprintf("Location: %s", $insertGoTo);
}
mysqli_select_db($Myconnection, $database_Myconnection);
$query_RCBaohiem_TM = "SELECT * FROM tlb_baohiem where ma_nhan_vien = '$ma_nv'";
$RCBaohiem_TM = mysqli_query($Myconnection, $query_RCBaohiem_TM);
$row_RCBaohiem_TM = mysqli_fetch_assoc($RCBaohiem_TM);
$totalRows_RCBaohiem_TM = mysqli_num_rows($RCBaohiem_TM);
if ($totalRows_RCBaohiem_TM <>0)
	{
  	$url = "index.php?require=cap_nhat_bao_hiem.php&catID=$ma_nv&title=Cập nhật bảo hiểm";
	location($url);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link rel="stylesheet" type="text/css" href="css/main.css" media="screen">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<body text="#000000" link="#CC0000" vlink="#0000CC" alink="#000099">
<table class="row6" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="20%"><a href="index.php?require=them_moi_quan_he_gia_dinh.php&catID=<?php echo $ma_nv; ?>&title=Quan hệ gia đình">Quan hệ gia đình</a></td>
          <td width="20%" align="center"><a href="index.php?require=them_moi_qua_trinh_cong_tac.php&catID=<?php echo $ma_nv; ?>&title=Quá trình công tác">Quá trình công tác</a></td>
          <td width="19%" align="center"><a href="index.php?require=them_moi_qua_trinh_luong.php&catID=<?php echo $ma_nv; ?>&title=Quá trình lương">Quá trình lương</a></td>
          <td width="20%" align="center"><a href="index.php?require=them_moi_hop_dong.php&catID=<?php echo $ma_nv; ?>&title=Hợp đồng">Hợp đồng</a></td>
          <td width="20%" align="center"><a href="index.php?require=them_moi_bao_hiem.php&catID=<?php echo $ma_nv; ?>&title=Bảo hiểm">Bảo hiểm</a></td>
        </tr>
      </table>
<?php
		if ($totalRows_RCBaohiem_TM<>0)
		{
	?>
<table class="row2" width="800" border="0" cellspacing="1" cellpadding="1" align="center">
  <tr>
    <th width="100">Số sổ BHXH</th>
    <th width="66">Ngày cấp</th>
    <th width="109">Nơi cấp</th>
    <th width="100">Số sổ BHYT</th>
    <th width="83">Ngày cấp</th>
    <th width="109">Nơi cấp</th>
    <th colspan="2">&nbsp;</th>
  </tr>
  <tr>
    <td class="row1"><?php echo $row_RCBaohiem_TM['so_bhxh']; ?></td>
    <td class="row1"><?php echo $row_RCBaohiem_TM['ngay_cap_bhxh']; ?></td>
    <td class="row1"><?php echo $row_RCBaohiem_TM['noi_cap_bhxh']; ?></td>
    <td class="row1"><?php echo $row_RCBaohiem_TM['so_bhyt']; ?></td>
    <td class="row1"><?php echo $row_RCBaohiem_TM['ngay_cap_bhyt']; ?></td>
    <td class="row1"><?php echo $row_RCBaohiem_TM['noi_cap_bhyt']; ?></td>
    <td width="35" class="row1"><a href="index.php?require=cap_nhat_bao_hiem.php&catID=<?php echo $ma_nv; ?>&title=Cập nhật bảo hiểm">Sửa</a></td>
    <td width="35" class="row1">Xoá</td>
  </tr>
</table>
	<?php
		}
	?>
<p></p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="row2" width="800" align="center" cellpadding="3" cellspacing="3">
    <tr valign="baseline">
      <td width="133" align="right" nowrap="nowrap">Mã nhân viên:</td>
      <td width="211"><input type="text" name="ma_nhan_vien" value="<?php echo $ma_nv; ?>" readonly="readonly" size="32" /></td>
      <td width="129">&nbsp;</td>
      <td width="286">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Số sổ BHXH</td>
      <td><input type="text" name="so_bhxh" value="" size="32" /></td>
      <td>Số sổ BHYT:</td>
      <td><input type="text" name="so_bhyt" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ngày cấp BHXH:</td>
      <td><input type="text" name="ngay_cap_bhxh" value="" size="32" /></td>
      <td>Ngày cấp BHYT:</td>
      <td><input type="text" name="ngay_cap_bhyt" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nơi cấp BHXH:</td>
      <td><input type="text" name="noi_cap_bhxh" value="" size="32" /></td>
      <td>Nơi cấp BHYT:</td>
      <td><input type="text" name="noi_cap_bhyt" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="4" align="center" nowrap="nowrap"><input type="submit" value=":|: Thêm mới :|:" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p></p>
</body>
</html>
<?php
mysqli_free_result($RCBaohiem_TM);
?>

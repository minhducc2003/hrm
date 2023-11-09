<?php require_once('Connections/Myconnection.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO tlb_quatrinhcongtac (ma_nhan_vien, so_quyet_dinh, ngay_ky, ngay_hieu_luc, cong_viec, ghi_chu) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ma_nhan_vien'], "text"),
                       GetSQLValueString($_POST['so_quyet_dinh'], "text"),
                       GetSQLValueString($_POST['ngay_ky'], "date"),
                       GetSQLValueString($_POST['ngay_hieu_luc'], "date"),
                       GetSQLValueString($_POST['cong_viec'], "text"),
                       GetSQLValueString($_POST['ghi_chu'], "text"));

  mysqli_select_db($Myconnection, $database_Myconnection);
  $Result1 = mysqli_query($Myconnection, $insertSQL) or die(mysqli_error());

  $insertGoTo = "them_moi_qua_trinh_cong_tac.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  sprintf("Location: %s", $insertGoTo);
}

mysqli_select_db($Myconnection, $database_Myconnection);
$query_RCQuatrinh_TM = "SELECT * FROM tlb_quatrinhcongtac where ma_nhan_vien = '$ma_nv'";
$RCQuatrinh_TM = mysqli_query($Myconnection, $query_RCQuatrinh_TM) or die(mysqli_error());
$row_RCQuatrinh_TM = mysqli_fetch_assoc($RCQuatrinh_TM);
$totalRows_RCQuatrinh_TM = mysqli_num_rows($RCQuatrinh_TM);
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
if ($totalRows_RCQuatrinh_TM<>0)
{
?>
<table class="row2" width="800" border="0" cellspacing="1" cellpadding="1" align="center">
  <tr>
    <th width="120">Số QĐ</th>
    <th width="80">Ngày ký</th>
    <th width="100">Ngày hiệu lực</th>
    <th width="150">Công việc</th>
    <th width="200">Ghi chú</th>
    <th colspan="3">&nbsp;</th>
  </tr>
  <?php do { ?>
    <tr class="row2">
      <td class="row1"><?php echo $row_RCQuatrinh_TM['so_quyet_dinh']; ?></td>
      <td class="row1"><?php echo $row_RCQuatrinh_TM['ngay_ky']; ?></td>
      <td class="row1"><?php echo $row_RCQuatrinh_TM['ngay_hieu_luc']; ?></td>
      <td class="row1"><?php echo $row_RCQuatrinh_TM['cong_viec']; ?></td>
      <td class="row1"><?php echo $row_RCQuatrinh_TM['ghi_chu']; ?></td>
      <td width="50" class="row1"><a href="index.php?require=them_moi_qua_trinh_cong_tac.php&catID=<?php echo $ma_nv; ?>&title=Quá trình công tác">Thêm</a></td>
      <td width="50" class="row1"><a href="index.php?require=cap_nhat_qua_trinh_cong_tac.php&catID=<?php echo $ma_nv; ?>&tomID=<?php echo $row_RCQuatrinh_TM['id']; ?>&title=Cập nhật quá trình công tác">Sửa</a></td>
      <td width="50" class="row1">Xoá</td>
    </tr>
    <?php } while ($row_RCQuatrinh_TM = mysqli_fetch_assoc($RCQuatrinh_TM)); ?>
</table>
<?php
}
?>
<p></p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="row2" width="800" align="center" cellpadding="1" cellspacing="1">
    <tr valign="baseline">
      <td width="137" align="right" nowrap="nowrap">Mã nhân viên:</td>
      <td width="229"><input type="text" name="ma_nhan_vien" value="<?php echo $ma_nv; ?>" readonly="readonly" size="32" /></td>
      <td width="130">Ngày ký:</td>
      <td width="284"><input type="date" name="ngay_ky" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Số quyết định:</td>
      <td><input type="text" name="so_quyet_dinh" value="" size="32" /></td>
      <td>Ngày hiệu lực:</td>
      <td><input type="date" name="ngay_hieu_luc" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Công việc:</td>
      <td colspan="3"><input type="text" name="cong_viec" value="" size="80" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ghi chú:</td>
      <td colspan="3"><input type="text" name="ghi_chu" value="" size="80" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="4" align="center" nowrap="nowrap"><input type="submit" value=":|: Đồng ý :|:" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
</body>
</html>
<?php
mysqli_free_result($RCQuatrinh_TM);
?>

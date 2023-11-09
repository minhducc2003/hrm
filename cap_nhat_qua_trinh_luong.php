<?php require_once('Connections/Myconnection.php'); ?>
<?php
$ma_nv = $_GET['catID'];
$id = $_GET['tomID'];
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tlb_quatrinhluong SET ma_nhan_vien=%s, so_quyet_dinh=%s, ngay_chuyen=%s, muc_luong=%s, ghi_chu=%s WHERE id=%s",
                       GetSQLValueString($_POST['ma_nhan_vien'], "text"),
                       GetSQLValueString($_POST['so_quyet_dinh'], "text"),
                       GetSQLValueString($_POST['ngay_chuyen'], "date"),
                       GetSQLValueString($_POST['muc_luong'], "text"),
                       GetSQLValueString($_POST['ghi_chu'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysqli_select_db($Myconnection, $database_Myconnection);
  $Result1 = mysqli_query($Myconnection, $updateSQL);
}
mysqli_select_db($Myconnection, $database_Myconnection);
$query_RCQTluong_DS = "SELECT * FROM tlb_quatrinhluong where ma_nhan_vien = '$ma_nv'";
$RCQTluong_DS = mysqli_query($Myconnection, $query_RCQTluong_DS);
$row_RCQTluong_DS = mysqli_fetch_assoc($RCQTluong_DS);
$totalRows_RCQTluong_DS = mysqli_num_rows($RCQTluong_DS);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
<table width="800" border="0" cellspacing="1" cellpadding="0" align="center">
  <tr>
    <td class="row2" width="490" valign="top"><table width="490" border="0" cellspacing="1" cellpadding="0" align="center">
      <tr>
        <th width="185">Số quyết định</th>
        <th width="100">Ngày chuyển</th>
        <th width="80">Mức lương</th>
        <th colspan="3">&nbsp;</th>
        </tr>
      <?php do { ?>
        <tr>
          <td class="row1"><?php echo $row_RCQTluong_DS['so_quyet_dinh']; ?></td>
          <td class="row1"><?php echo $row_RCQTluong_DS['ngay_chuyen']; ?></td>
          <td class="row1"><?php echo $row_RCQTluong_DS['muc_luong']; ?></td>
          <td width="35" class="row1"><a href="index.php?require=them_moi_qua_trinh_luong.php&catID=<?php echo $ma_nv; ?>&title=Quá trình lương">Thêm</a></td>
          <td width="35" class="row1"><a href="index.php?require=cap_nhat_qua_trinh_luong.php&catID=<?php echo $ma_nv; ?>&tomID=<?php echo $row_RCQTluong_DS['id']; ?>&title=Cập nhật quá trình lương">Sửa</a></td>
          <td width="35" class="row1">Xoá</td>
        </tr>
        <?php } while ($row_RCQTluong_DS = mysqli_fetch_assoc($RCQTluong_DS)); ?>
    </table></td>
    <?php
	mysqli_free_result($RCQTluong_DS);
	?>
    <td class="row2" width="286" valign="top">
    <?php
	mysqli_select_db($Myconnection, $database_Myconnection);
		$query_RCQTluong_CN = "SELECT * FROM tlb_quatrinhluong where id = $id";
		$RCQTluong_CN = mysqli_query($Myconnection, $query_RCQTluong_CN) or die(mysqli_error());
		$row_RCQTluong_CN = mysqli_fetch_assoc($RCQTluong_CN);
		$totalRows_RCQTluong_CN = mysqli_num_rows($RCQTluong_CN);	
	?>
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table width="286" align="center" cellpadding="1" cellspacing="1">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Mã nhân viên:</td>
            <td><input type="text" name="ma_nhan_vien" value="<?php echo htmlentities($row_RCQTluong_CN['ma_nhan_vien'], ENT_COMPAT, 'utf-8'); ?>" size="28" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Số quyết định:</td>
            <td><input type="text" name="so_quyet_dinh" value="<?php echo htmlentities($row_RCQTluong_CN['so_quyet_dinh'], ENT_COMPAT, 'utf-8'); ?>" size="28" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Ngày chuyển:</td>
            <td><input type="date" name="ngay_chuyen" value="<?php echo htmlentities($row_RCQTluong_CN['ngay_chuyen'], ENT_COMPAT, 'utf-8'); ?>" size="28" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Mức lương:</td>
            <td><input type="text" name="muc_luong" value="<?php echo htmlentities($row_RCQTluong_CN['muc_luong'], ENT_COMPAT, 'utf-8'); ?>" size="28" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Ghi chú:</td>
            <td><input type="text" name="ghi_chu" value="<?php echo htmlentities($row_RCQTluong_CN['ghi_chu'], ENT_COMPAT, 'utf-8'); ?>" size="28" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value=":|: Cập nhật :|:" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="form1" />
        <input type="hidden" name="id" value="<?php echo $row_RCQTluong_CN['id']; ?>" />
      </form>
    </td>
  </tr>
</table>
</body>
</html>
<?php
mysqli_free_result($RCQTluong_CN);
?>

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
  $updateSQL = sprintf("UPDATE tlb_quanhegiadinh SET ma_nhan_vien=%s, ten_nguoi_than=%s, nam_sinh=%s, moi_quan_he=%s, nghe_nghiep=%s, dia_chi=%s, noi_lam=%s, dtdd=%s, dtcq=%s, ghi_chu=%s WHERE id=%s",
                       GetSQLValueString($_POST['ma_nhan_vien'], "text"),
                       GetSQLValueString($_POST['ten_nguoi_than'], "text"),
                       GetSQLValueString($_POST['nam_sinh'], "int"),
                       GetSQLValueString($_POST['moi_quan_he'], "text"),
                       GetSQLValueString($_POST['nghe_nghiep'], "text"),
                       GetSQLValueString($_POST['dia_chi'], "text"),
                       GetSQLValueString($_POST['noi_lam'], "text"),
                       GetSQLValueString($_POST['dtdd'], "text"),
                       GetSQLValueString($_POST['dtcq'], "text"),
                       GetSQLValueString($_POST['ghi_chu'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysqli_select_db($Myconnection, $database_Myconnection);
  $Result1 = mysqli_query($Myconnection, $updateSQL);

  $updateGoTo = "them_moi_quan_he_gia_dinh.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css"></style></head>

<body text="#000000" link="#CC0000" vlink="#0000CC" alink="#000099">
<table class="row6" width="100%" border="0" cellspacing="0" cellpadding="0" style="border: 1px solid #66CCFF;background-color: white">
        <tr>
          <td width="20%"><a href="index.php?require=them_moi_quan_he_gia_dinh.php&catID=<?php echo $ma_nv; ?>&title=Quan hệ gia đình&action=new">Quan hệ gia đình</a></td>
          <td width="20%" align="center"><a href="index.php?require=them_moi_qua_trinh_cong_tac.php&catID=<?php echo $ma_nv; ?>&title=Quá trình công tác&action=new">Quá trình công tác</a></td>
          <td width="19%" align="center"><a href="index.php?require=them_moi_qua_trinh_luong.php&catID=<?php echo $ma_nv; ?>&title=Quá trình lương&action=new">Quá trình lương</a></td>
          <td width="20%" align="center"><a href="index.php?require=them_moi_hop_dong.php&catID=<?php echo $ma_nv; ?>&title=Hợp đồng&action=new">Hợp đồng</a></td>
          <td width="20%" align="center"><a href="index.php?require=them_moi_bao_hiem.php&catID=<?php echo $ma_nv; ?>&title=Bảo hiểm&action=new">Bảo hiểm</a></td>
        </tr>
      </table>
<table border="0" bordercolor="#C00" width="800" align="center" cellpadding="0" cellspacing="0" style="border: 1px solid black;background-color: white"> 
  <tr>
    <td width="475" class="row2" valign="top">
   <?php
   mysqli_select_db($Myconnection, $database_Myconnection);
   $query_RCQuanhe_DS = "SELECT * FROM tlb_quanhegiadinh where ma_nhan_vien = '$ma_nv'";
	$RCQuanhe_DS = mysqli_query($Myconnection, $query_RCQuanhe_DS);
	$row_RCQuanhe_DS = mysqli_fetch_assoc($RCQuanhe_DS);
	$totalRows_RCQuanhe_DS = mysqli_num_rows($RCQuanhe_DS); ?>
      <table border="1" width="475" align="center" cellpadding="1" cellspacing="1">
        <tr style="background-color: black;color: white">
          <th width="170">Tên người thân</th>
          <th width="65">Quan hệ</th>
          <th width="80">ĐTDĐ</th>
          <th colspan="3">&nbsp;</th>
        </tr>
              <?php do { ?>
              <tr>
                <td class="row1"><?php echo $row_RCQuanhe_DS['ten_nguoi_than']; ?></td>
                <td class="row1" align="center"><?php echo $row_RCQuanhe_DS['moi_quan_he']; ?></td>
                <td class="row1" align="center"><?php echo $row_RCQuanhe_DS['dtdd']; ?></td>
                <td width="40" class="row1"><a href="index.php?require=them_moi_quan_he_gia_dinh.php&catID=<?php echo $ma_nv; ?>&title=Quan hệ gia đình">Thêm</a></td>
                <td width="40" class="row1"><a href="index.php?require=cap_nhat_quan_he_gia_dinh.php&catID=<?php echo $ma_nv; ?>&tomID=<?php echo $row_RCQuanhe_DS['id']; ?>&title=Cập nhật quan hệ gia đình">Sửa</a></td>
                <td width="40" class="row1">Xoá</td>
        	</tr>
             <?php } while ($row_RCQuanhe_DS = mysqli_fetch_assoc($RCQuanhe_DS)); ?>
		</table>
		<?php
			mysqli_free_result($RCQuanhe_DS);
		?>
</td>
      <td class="row2" width="290">
      <?php
	  	mysqli_select_db($Myconnection, $database_Myconnection);
		$query_RCQuanhe_CN = "SELECT * FROM tlb_quanhegiadinh where id= $id";
		$RCQuanhe_CN = mysqli_query($Myconnection, $query_RCQuanhe_CN) or die(mysqli_error());
		$row_RCQuanhe_CN = mysqli_fetch_assoc($RCQuanhe_CN);
		$totalRows_RCQuanhe_CN = mysqli_num_rows($RCQuanhe_CN);
	  ?>
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table width="290" align="center">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Mã nhân viên:</td>
            <td><input type="text" name="ma_nhan_vien" value="<?php echo htmlentities($row_RCQuanhe_CN['ma_nhan_vien'], ENT_COMPAT, 'utf-8'); ?>" readonly="readonly" size="29" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Tên người thân:</td>
            <td><input type="text" name="ten_nguoi_than" value="<?php echo htmlentities($row_RCQuanhe_CN['ten_nguoi_than'], ENT_COMPAT, 'utf-8'); ?>" size="29" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Năm sinh:</td>
            <td><input type="text" name="nam_sinh" value="<?php echo htmlentities($row_RCQuanhe_CN['nam_sinh'], ENT_COMPAT, 'utf-8'); ?>" size="29" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Mối quan hệ:</td>
            <td><input type="text" name="moi_quan_he" value="<?php echo htmlentities($row_RCQuanhe_CN['moi_quan_he'], ENT_COMPAT, 'utf-8'); ?>" size="29" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Nghề nghiệp:</td>
            <td><input type="text" name="nghe_nghiep" value="<?php echo htmlentities($row_RCQuanhe_CN['nghe_nghiep'], ENT_COMPAT, 'utf-8'); ?>" size="29" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Địa chỉ:</td>
            <td><input type="text" name="dia_chi" value="<?php echo htmlentities($row_RCQuanhe_CN['dia_chi'], ENT_COMPAT, 'utf-8'); ?>" size="29" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Nơi làm:</td>
            <td><input type="text" name="noi_lam" value="<?php echo htmlentities($row_RCQuanhe_CN['noi_lam'], ENT_COMPAT, 'utf-8'); ?>" size="29" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">ĐT di động:</td>
            <td><input type="text" name="dtdd" value="<?php echo htmlentities($row_RCQuanhe_CN['dtdd'], ENT_COMPAT, 'utf-8'); ?>" size="29" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">ĐT cơ quan:</td>
            <td><input type="text" name="dtcq" value="<?php echo htmlentities($row_RCQuanhe_CN['dtcq'], ENT_COMPAT, 'utf-8'); ?>" size="29" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Ghi chú:</td>
            <td><input type="text" name="ghi_chu" value="<?php echo htmlentities($row_RCQuanhe_CN['ghi_chu'], ENT_COMPAT, 'utf-8'); ?>" size="29" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value=":|: Cập nhật :|:" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="form1" />
        <input type="hidden" name="id" value="<?php echo $row_RCQuanhe_CN['id']; ?>" />
      </form>
      <?php
		mysqli_free_result($RCQuanhe_CN);
		?>
    </td>
    </tr>
</table>
</body>
</html>
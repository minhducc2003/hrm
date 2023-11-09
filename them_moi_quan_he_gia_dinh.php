<?php
$ma_nv = get_param('catID');
$action = get_param('action');
//Thực hiện lệnh xoá nếu chọn xoá
if ($action=="del")
{
	$tomID = $_GET['tomID'];
	$deleteSQL = "DELETE FROM tlb_quanhegiadinh WHERE id=$tomID";                     
	
	  mysqli_select_db($Myconnection, $database_Myconnection);
	  $Result1 = mysqli_query($Myconnection, $deleteSQL) or die(mysqli_error());
	
	  $deleteGoTo = "them_danh_muc.php";
	  if (isset($_SERVER['QUERY_STRING'])) {
		$deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
		$deleteGoTo .= $_SERVER['QUERY_STRING'];
	  }
	  sprintf("Location: %s", $deleteGoTo);
}
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
  $insertSQL = sprintf("INSERT INTO tlb_quanhegiadinh (ma_nhan_vien, ten_nguoi_than, nam_sinh, moi_quan_he, nghe_nghiep, dia_chi, noi_lam, dtdd, dtcq, ghi_chu) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ma_nhan_vien'], "text"),
                       GetSQLValueString($_POST['ten_nguoi_than'], "text"),
                       GetSQLValueString($_POST['nam_sinh'], "int"),
                       GetSQLValueString($_POST['moi_quan_he'], "text"),
                       GetSQLValueString($_POST['nghe_nghiep'], "text"),
                       GetSQLValueString($_POST['dia_chi'], "text"),
                       GetSQLValueString($_POST['noi_lam'], "text"),
                       GetSQLValueString($_POST['dtdd'], "text"),
                       GetSQLValueString($_POST['dtcq'], "text"),
                       GetSQLValueString($_POST['ghi_chu'], "text"));

  mysqli_select_db($Myconnection, $database_Myconnection);
  $Result1 = mysqli_query($Myconnection, $insertSQL) or die(mysqli_error());

  $insertGoTo = "cap_nhat_quan_he_gia_dinh.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  sprintf("Location: %s", $insertGoTo);
}

mysqli_select_db($Myconnection, $database_Myconnection);
$query_RCQuanHeGD = "SELECT * FROM tlb_quanhegiadinh where ma_nhan_vien = '$ma_nv'";
$RCQuanHeGD = mysqli_query($Myconnection, $query_RCQuanHeGD) or die(mysqli_error());
$row_RCQuanHeGD = mysqli_fetch_assoc($RCQuanHeGD);
$totalRows_RCQuanHeGD = mysqli_num_rows($RCQuanHeGD);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link rel="stylesheet" type="text/css" href="js/superfish/css/superfish.css" media="screen">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title></head>

<body text="#000000" link="#CC0000" vlink="#0000CC" alink="#000099">
<table class="row6" width="100%" border="0" cellspacing="0" cellpadding="0" style="border: 1px solid #66CCFF;background-color: white">
        <tr>
          <td width="20%"><a href="index.php?require=them_moi_quan_he_gia_dinh.php&catID=<?php echo $ma_nv; ?>&title=Quan hệ gia đình&action=new">Quan hệ gia đình</a></td>
          <td width="20%" align="center"><a href="index.php?require=them_moi_qua_trinh_cong_tac.php&catID=<?php echo $ma_nv; ?>&title=Quá trình công tác">Quá trình công tác</a></td>
          <td width="19%" align="center"><a href="index.php?require=them_moi_qua_trinh_luong.php&catID=<?php echo $ma_nv; ?>&title=Quá trình lương">Quá trình lương</a></td>
          <td width="20%" align="center"><a href="index.php?require=them_moi_hop_dong.php&catID=<?php echo $ma_nv; ?>&title=Hợp đồng">Hợp đồng</a></td>
          <td width="20%" align="center"><a href="index.php?require=them_moi_bao_hiem.php&catID=<?php echo $ma_nv; ?>&title=Bảo hiểm">Bảo hiểm</a></td>
        </tr>
      </table>
<table border="0" width="800" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td class="row2" width="460" valign="top">
      <?php
		if ($totalRows_RCQuanHeGD<>0)
		{
		?>
      <table border="1" width="460" align="center" cellpadding="1" cellspacing="1">
        <tr style="background-color: black;color: white">
          <th width="170">Tên người thân</th>
          <th width="65">Quan hệ</th>
          <th width="80">ĐT</th>
          <th width="40">&nbsp;</th>
          <th width="40">&nbsp;</th>
          <th width="40">&nbsp;</th>
        </tr>
        <?php do { ?>
          <tr>
            <td class="row1"><?php echo $row_RCQuanHeGD['ten_nguoi_than']; ?></td>
            <td class="row1" align="center"><?php echo $row_RCQuanHeGD['moi_quan_he']; ?></td>
            <td class="row1" align="center"><?php echo $row_RCQuanHeGD['dtdd']; ?></td>
            <?php $ma_id = $row_RCQuanHeGD['id']; ?>
            <td class="row1"><a href="index.php?require=them_moi_quan_he_gia_dinh.php&catID=<?php echo $ma_nv; ?>&title=Thêm mới quan hệ gia đình">Thêm</a></td>
            <td class="row1"><a href="index.php?require=cap_nhat_quan_he_gia_dinh.php&catID=<?php echo $ma_nv; ?>&tomID=<?php echo $row_RCQuanHeGD['id']; ?>&title=Cập nhật quan hệ gia đình">Sửa</a></td>
            <td class="row1"><a href="index.php?require=them_moi_quan_he_gia_dinh.php&catID=<?php echo $ma_nv; ?>&tomID=<?php echo $row_RCQuanHeGD['id']; ?>&title=Cập nhật quan hệ gia đình&action=del">Xoá</a></td>
          </tr>
          <?php } while ($row_RCQuanHeGD = mysqli_fetch_assoc($RCQuanHeGD)); ?>
      </table>
      <?php
		}
		?>
      </td>
      <td class="row2" width="290">
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="290" align="center" style="border: 1px solid #66CCFF">
    <tr valign="baseline" >
      <td nowrap="nowrap" align="right">Mã nhân viên:</td>
      <td><input type="text" name="ma_nhan_vien" value="<?php echo $ma_nv; ?>" readonly="readonly" size="29" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tên người thân:</td>
      <td><input type="text" name="ten_nguoi_than" value="" size="29" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Năm sinh:</td>
      <td><input type="text" name="nam_sinh" value="" size="29" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Mối quan hệ:</td>
      <td><input type="text" name="moi_quan_he" value="" size="29" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nghề nghiệp:</td>
      <td><input type="text" name="nghe_nghiep" value="" size="29" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Địa chỉ:</td>
      <td><input type="text" name="dia_chi" value="" size="29" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nơi làm:</td>
      <td><input type="text" name="noi_lam" value="" size="29" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ĐT di động:</td>
      <td><input type="text" name="dtdd" value="" size="29" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ĐT cơ quan:</td>
      <td><input type="text" name="dtcq" value="" size="29" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ghi chú:</td>
      <td><input type="text" name="ghi_chu" value="" size="29" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Thêm quan hệ" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
</td>
    </tr>
</table>
</body>
</html>
<?php
mysqli_free_result($RCQuanHeGD);
?>

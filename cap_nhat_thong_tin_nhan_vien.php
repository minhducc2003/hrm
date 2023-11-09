<?php
require_once('tim_phan_quyen.php');

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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	//Chuyển ngày tháng nhập vào sang định dạng Y/M/D
	/*tai hinh anh len
  	  if ($_FILES["hinh_anh"]["error"] > 0)
	  {
	echo "Error: " . $_FILES["hinh_anh"]["error"] . "<br />";
	exit;
	  }
	  else
	  move_uploaded_file($_FILES["hinh_anh"][tmp_name],"images/" . $_FILES["hinh_anh"]["name"]);
	$luutru = "luu tru tai: " . "images/" . $_FILES["hinh_anh"]["name"]; */
  //bat dau cập nhật
  $updateSQL = sprintf("UPDATE tlb_nhanvien SET ho_ten=%s, gioi_tinh=%s, gia_dinh=%s, dt_di_dong=%s, dt_nha=%s, email=%s, ngay_sinh=%s, noi_sinh=%s, tinh_thanh=%s, cmnd=%s, ngay_cap=%s, noi_cap=%s, que_quan=%s, dia_chi=%s, tam_tru=%s, hinh_anh=%s, nghi_viec=%s WHERE ma_nhan_vien=%s",
                       GetSQLValueString($_POST['ho_ten'], "text"),
                       GetSQLValueString($_POST['gioi_tinh'], "int"),
                       GetSQLValueString($_POST['gia_dinh'], "int"),
                       GetSQLValueString($_POST['dt_di_dong'], "text"),
                       GetSQLValueString($_POST['dt_nha'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['ngay_sinh'], "date"),
                       GetSQLValueString($_POST['noi_sinh'], "text"),
                       GetSQLValueString($_POST['tinh_thanh'], "text"),
                       GetSQLValueString($_POST['cmnd'], "text"),
                       GetSQLValueString($_POST['ngay_cap'], "date"),
                       GetSQLValueString($_POST['noi_cap'], "text"),
                       GetSQLValueString($_POST['que_quan'], "text"),
                       GetSQLValueString($_POST['dia_chi'], "text"),
                       GetSQLValueString($_POST['tam_tru'], "text"),
                       GetSQLValueString($_POST['hinh_anh'], "text"),
					   GetSQLValueString($_POST['nghi_viec'], "int"),
                       GetSQLValueString($_POST['ma_nhan_vien'], "text"));

  mysqli_select_db($Myconnection, $database_Myconnection);
  $Result1 = mysqli_query($Myconnection, $updateSQL);

  $updateGoTo = "danh_sach_nhan_vien.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  location($$updateGoTo);
}

mysqli_select_db($Myconnection, $database_Myconnection);
$query_RCcapnhat_nhanvien = "SELECT * FROM tlb_nhanvien where ma_nhan_vien = '$ma_nv'";
$RCcapnhat_nhanvien = mysqli_query($Myconnection, $query_RCcapnhat_nhanvien);
$row_RCcapnhat_nhanvien = mysqli_fetch_assoc($RCcapnhat_nhanvien);
$totalRows_RCcapnhat_nhanvien = mysqli_num_rows($RCcapnhat_nhanvien);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link rel="stylesheet" type="text/css" href="css/main.css" media="screen">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>></head>

<body text="#000000" link="#CC0000" alink="#000099">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border: 1px solid #66CCFF;background-color: white">
        <tr>
          <td width="20%"><a href="index.php?require=them_moi_quan_he_gia_dinh.php&catID=<?php echo $ma_nv; ?>&title=Quan hệ gia đình&action=new">Quan hệ gia đình</a></td>
          <td width="20%" align="center"><a href="index.php?require=them_moi_qua_trinh_cong_tac.php&catID=<?php echo $ma_nv; ?>&title=Quá trình công tác&action=new">Quá trình công tác</a></td>
          <td width="19%" align="center"><a href="index.php?require=them_moi_qua_trinh_luong.php&catID=<?php echo $ma_nv; ?>&title=Quá trình lương&action=new">Quá trình lương</a></td>
          <td width="20%" align="center"><a href="index.php?require=them_moi_hop_dong.php&catID=<?php echo $ma_nv; ?>&title=Hợp đồng&action=new">Hợp đồng</a></td>
          <td width="20%" align="center"><a href="index.php?require=them_moi_bao_hiem.php&catID=<?php echo $ma_nv; ?>&title=Bảo hiểm&action=new">Bảo hiểm</a></td>
        </tr>
      </table>
  <table class="row2" width="800" align="center" cellpadding="2" cellspacing="2" style="border: 1px solid #66CCFF;">
    <tr valign="baseline">
      <td width="115" align="right" nowrap="nowrap">Mã nhân viên:</td>
      <td width="318"><?php echo $row_RCcapnhat_nhanvien['ma_nhan_vien']; ?></td>
      <td  align="right" width="68">Tình trạng:</td>
      <td width="271">
      <?php
	  if ($row_RCcapnhat_nhanvien['nghi_viec']==0)
	  {
	  ?>
      <select name="nghi_viec">
      	<option selected="selected" value="0">Làm việc </option>
        <option value="1">Nghỉ việc </option>
      </select>
      <?php
	  }
	  else
	  {
	  ?>
      <select name="nghi_viec">
      	<option selected="selected" value="1">Nghỉ việc </option>
        <option value="0">Làm việc </option>
      </select>
      <?php
	  }
	  ?>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Họ và tên:</td>
      <td><input type="text" name="ho_ten" value="<?php echo htmlentities($row_RCcapnhat_nhanvien['ho_ten'], ENT_COMPAT, 'utf-8'); ?>" size="50" /></td>
      <td align="right">Ngày sinh:</td>
      <td><input type="date" name="ngay_sinh" value="<?php echo $row_RCcapnhat_nhanvien['ngay_sinh']; ?>" size="17" />(dd-mm-yyyy)</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Giới tính:</td>
      <td><select name="gioi_tinh">
        <option value="1" <?php if (!(strcmp(1, htmlentities($row_RCcapnhat_nhanvien['gioi_tinh'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Nam</option>
        <option value="0" <?php if (!(strcmp(0, htmlentities($row_RCcapnhat_nhanvien['gioi_tinh'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Nữ</option>
      </select></td>
      <td align="right">Nơi sinh:</td>
      <td><input type="text" name="noi_sinh" value="<?php echo htmlentities($row_RCcapnhat_nhanvien['noi_sinh'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Gia đình:</td>
      <td><select name="gia_dinh">
        <option value="1" <?php if (!(strcmp(1, htmlentities($row_RCcapnhat_nhanvien['gia_dinh'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Có gia đình</option>
        <option value="0" <?php if (!(strcmp(0, htmlentities($row_RCcapnhat_nhanvien['gia_dinh'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Chưa có</option>
      </select></td>
      <td align="right">Tỉnh thành:</td>
      <td><input type="text" name="tinh_thanh" value="<?php echo htmlentities($row_RCcapnhat_nhanvien['tinh_thanh'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Di động:</td>
      <td><input type="text" name="dt_di_dong" value="<?php echo htmlentities($row_RCcapnhat_nhanvien['dt_di_dong'], ENT_COMPAT, 'utf-8'); ?>" size="50" /></td>
      <td align="right">CMND:</td>
      <td><input type="text" name="cmnd" value="<?php echo htmlentities($row_RCcapnhat_nhanvien['cmnd'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Điện thoại nhà:</td>
      <td><input type="text" name="dt_nha" value="<?php echo htmlentities($row_RCcapnhat_nhanvien['dt_nha'], ENT_COMPAT, 'utf-8'); ?>" size="50" /></td>
      <td align="right">Ngày cấp:</td>
      <td><input type="date" name="ngay_cap" value="<?php echo htmlentities($row_RCcapnhat_nhanvien['ngay_cap'], ENT_COMPAT, 'utf-8'); ?>" size="17" />
        (yyyy-mm-dd)</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Email:</td>
      <td><input type="text" name="email" value="<?php echo htmlentities($row_RCcapnhat_nhanvien['email'], ENT_COMPAT, 'utf-8'); ?>" size="50" /></td>
      <td align="right">Nơi cấp:</td>
      <td><input type="text" name="noi_cap" value="<?php echo htmlentities($row_RCcapnhat_nhanvien['noi_cap'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Quê quán:</td>
      <td colspan="2"><input type="text" name="que_quan" value="<?php echo htmlentities($row_RCcapnhat_nhanvien['que_quan'], ENT_COMPAT, 'utf-8'); ?>" size="65" /></td>
      <td rowspan="4" valign="top" bordercolor="#CC0000" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center"><img src="images/<?php echo $row_RCcapnhat_nhanvien['hinh_anh']; ?>" width="120" height="130" align="top" /></td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Địa chỉ:</td>
      <td colspan="2"><input type="text" name="dia_chi" value="<?php echo htmlentities($row_RCcapnhat_nhanvien['dia_chi'], ENT_COMPAT, 'utf-8'); ?>" size="65" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tạm trú:</td>
      <td colspan="2"><input type="text" name="tam_tru" value="<?php echo htmlentities($row_RCcapnhat_nhanvien['tam_tru'], ENT_COMPAT, 'utf-8'); ?>" size="65" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Hình ảnh:</td>
      <td colspan="2"><input type="text" name="hinh_anh" value="<?php echo htmlentities($row_RCcapnhat_nhanvien['hinh_anh'], ENT_COMPAT, 'utf-8'); ?>" size="40" />
        <a target="_blank" href="quan_ly_anh.php">Tìm ảnh</a></td>
    </tr>
    <tr valign="baseline">
      <td colspan="4" align="right" nowrap="nowrap"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="4" align="center" nowrap="nowrap">
        <?php
        if($quyenSua == 1)
        {
        echo "<input class='button1' type='submit' value='Cập nhật' />";
        }
        else
        {
          echo "<input class='button1' type='submit' disabled value=':|: XXX :|:'' />";
        }
        ?>
      </td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="ma_nhan_vien" value="<?php echo $row_RCcapnhat_nhanvien['ma_nhan_vien']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysqli_free_result($RCcapnhat_nhanvien);
?>

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
  $updateSQL = sprintf("UPDATE tlb_congviec SET ngay_vao_lam=%s, phong_ban_id=%s, cong_viec_id=%s, chuc_vu_id=%s, muc_luong_cb=%s, he_so=%s, phu_cap=%s, so_sld=%s, ngay_cap=%s, noi_cap=%s, tknh=%s, ngan_hang=%s, hoc_van_id=%s, bang_cap_id=%s, ngoai_ngu_id=%s, tin_hoc_id=%s, dan_toc_id=%s, quoc_tich_id=%s, ton_giao_id=%s, tinh_thanh_id=%s WHERE ma_nhan_vien=%s",
                       GetSQLValueString($_POST['ngay_vao_lam'], "date"),
                       GetSQLValueString($_POST['phong_ban_id'], "text"),
                       GetSQLValueString($_POST['cong_viec_id'], "text"),
					   GetSQLValueString($_POST['chuc_vu_id'], "text"),
                       GetSQLValueString($_POST['muc_luong_cb'], "text"),
                       GetSQLValueString($_POST['he_so'], "text"),
                       GetSQLValueString($_POST['phu_cap'], "text"),
                       GetSQLValueString($_POST['so_sld'], "text"),
                       GetSQLValueString($_POST['ngay_cap'], "date"),
                       GetSQLValueString($_POST['noi_cap'], "text"),
                       GetSQLValueString($_POST['tknh'], "text"),
                       GetSQLValueString($_POST['ngan_hang'], "text"),
                       GetSQLValueString($_POST['hoc_van_id'], "text"),
                       GetSQLValueString($_POST['bang_cap_id'], "text"),
                       GetSQLValueString($_POST['ngoai_ngu_id'], "text"),
                       GetSQLValueString($_POST['tin_hoc_id'], "text"),
                       GetSQLValueString($_POST['dan_toc_id'], "text"),
                       GetSQLValueString($_POST['quoc_tich_id'], "text"),
                       GetSQLValueString($_POST['ton_giao_id'], "text"),
                       GetSQLValueString($_POST['tinh_thanh_id'], "text"),
                       GetSQLValueString($_POST['ma_nhan_vien'], "text"));

mysqli_select_db($Myconnection, $database_Myconnection);
mysqli_set_charset($Myconnection, 'utf8');
  $Result1 = mysqli_query($Myconnection, $updateSQL) or die(mysqli_error());

  $updateGoTo = "danh_sach_nhan_vien.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  sprintf("Location: %s", $updateGoTo);
}

mysqli_select_db($Myconnection, $database_Myconnection);
mysqli_set_charset($Myconnection, 'utf8');
$query_RCcapnhat_congviec = "SELECT * FROM tlb_congviec where ma_nhan_vien = '$ma_nv'";
$RCcapnhat_congviec = mysqli_query($Myconnection, $query_RCcapnhat_congviec) or die(mysqli_error());
$row_RCcapnhat_congviec = mysqli_fetch_assoc($RCcapnhat_congviec);
$totalRows_RCcapnhat_congviec = mysqli_num_rows($RCcapnhat_congviec);
if ($totalRows_RCcapnhat_congviec==0)
{
$url = "index.php?require=them_moi_cong_viec.php&catID=$ma_nv&title=Thêm mới công việc";
location($url);
}
$query_RCphongban1 = "SELECT * FROM tlb_phongban inner join tlb_congviec on tlb_phongban.phong_ban_id = tlb_congviec.phong_ban_id where tlb_congviec.ma_nhan_vien = '$ma_nv'";
$RCphongban1 = mysqli_query($Myconnection, $query_RCphongban1) or die(mysqli_error());
$row_RCphongban1 = mysqli_fetch_assoc($RCphongban1);
$totalRows_RCphongban1 = mysqli_num_rows($RCphongban1);
//lay danh sach khi phong ban cap nhat
$query_RCphongban = "SELECT * FROM tlb_phongban";
$RCphongban = mysqli_query($Myconnection, $query_RCphongban) or die(mysqli_error());
$row_RCphongban = mysqli_fetch_assoc($RCphongban);
$totalRows_RCphongban = mysqli_num_rows($RCphongban);
//lay cong viec hien tai
$query_RCctcongviec1 = "SELECT * FROM tlb_ctcongviec inner join tlb_congviec on tlb_ctcongviec.cong_viec_id = tlb_congviec.cong_viec_id where tlb_congviec.ma_nhan_vien = '$ma_nv'";
$RCctcongviec1 = mysqli_query($Myconnection, $query_RCctcongviec1) or die(mysqli_error());
$row_RCctcongviec1 = mysqli_fetch_assoc($RCctcongviec1);
$totalRows_RCctcongviec1 = mysqli_num_rows($RCctcongviec1);
//lay danh sach cong viec khi cap nhat
$query_RCctcongviec = "SELECT * FROM tlb_ctcongviec";
$RCctcongviec = mysqli_query($Myconnection, $query_RCctcongviec) or die(mysqli_error());
$row_RCctcongviec = mysqli_fetch_assoc($RCctcongviec);
$totalRows_RCctcongviec = mysqli_num_rows($RCctcongviec);
//lay chuc vu hien tai
$query_RCChucvu1 = "SELECT * FROM tlb_chucvu inner join tlb_congviec on tlb_chucvu.chuc_vu_id = tlb_congviec.chuc_vu_id where tlb_congviec.ma_nhan_vien = '$ma_nv'";
$RCChucvu1 = mysqli_query($Myconnection, $query_RCChucvu1) or die(mysqli_error());
$row_RCChucvu1 = mysqli_fetch_assoc($RCChucvu1);
$totalRows_RCChucvu1 = mysqli_num_rows($RCChucvu1);
//lay danh sach chuc vu
$query_RCChucvu = "SELECT * FROM tlb_chucvu";
$RCChucvu = mysqli_query($Myconnection, $query_RCChucvu) or die(mysqli_error());
$row_RCChucvu = mysqli_fetch_assoc($RCChucvu);
$totalRows_RCChucvu = mysqli_num_rows($RCChucvu);
//lay hoc van hien tai
$query_RCHocvan1 = "SELECT * FROM tlb_hocvan inner join tlb_congviec on tlb_hocvan.hoc_van_id = tlb_congviec.hoc_van_id where tlb_congviec.ma_nhan_vien = '$ma_nv'";
$RCHocvan1 = mysqli_query($Myconnection, $query_RCHocvan1) or die(mysqli_error());
$row_RCHocvan1 = mysqli_fetch_assoc($RCHocvan1);
$totalRows_RCHocvan1 = mysqli_num_rows($RCHocvan1);
//lay danh sach Hoc van
$query_RCHocvan = "SELECT * FROM tlb_hocvan";
$RCHocvan = mysqli_query($Myconnection, $query_RCHocvan) or die(mysqli_error());
$row_RCHocvan = mysqli_fetch_assoc($RCHocvan);
$totalRows_RCHocvan = mysqli_num_rows($RCHocvan);
//lay bang cap hien tai
$query_RCBangcap1 = "SELECT * FROM tlb_bangcap inner join tlb_congviec on tlb_bangcap.bang_cap_id = tlb_congviec.bang_cap_id where tlb_congviec.ma_nhan_vien = '$ma_nv'";
$RCBangcap1 = mysqli_query($Myconnection, $query_RCBangcap1) or die(mysqli_error());
$row_RCBangcap1 = mysqli_fetch_assoc($RCBangcap1);
$totalRows_RCBangcap1 = mysqli_num_rows($RCBangcap1);
// lay danh sach bang cap
$query_RCBangcap = "SELECT * FROM tlb_bangcap";
$RCBangcap = mysqli_query($Myconnection, $query_RCBangcap) or die(mysqli_error());
$row_RCBangcap = mysqli_fetch_assoc($RCBangcap);
$totalRows_RCBangcap = mysqli_num_rows($RCBangcap);
//lay ngoai ngu hien tai
$query_RCNgoaingu1 = "SELECT * FROM tlb_ngoaingu inner join tlb_congviec on tlb_ngoaingu.ngoai_ngu_id = tlb_congviec.ngoai_ngu_id where tlb_congviec.ma_nhan_vien = '$ma_nv'";
$RCNgoaingu1 = mysqli_query($Myconnection, $query_RCNgoaingu1) or die(mysqli_error());
$row_RCNgoaingu1 = mysqli_fetch_assoc($RCNgoaingu1);
$totalRows_RCNgoaingu1 = mysqli_num_rows($RCNgoaingu1);
//lay danh sach ngoai ngu
$query_RCNgoaingu = "SELECT * FROM tlb_ngoaingu";
$RCNgoaingu = mysqli_query($Myconnection, $query_RCNgoaingu) or die(mysqli_error());
$row_RCNgoaingu = mysqli_fetch_assoc($RCNgoaingu);
$totalRows_RCNgoaingu = mysqli_num_rows($RCNgoaingu);
//lay tin hoc hien tai
$query_RCTinhoc1 = "SELECT * FROM tlb_tinhoc inner join tlb_congviec on tlb_tinhoc.tin_hoc_id = tlb_congviec.tin_hoc_id where tlb_congviec.ma_nhan_vien = '$ma_nv'";
$RCTinhoc1 = mysqli_query($Myconnection, $query_RCTinhoc1) or die(mysqli_error());
$row_RCTinhoc1 = mysqli_fetch_assoc($RCTinhoc1);
$totalRows_RCTinhoc1 = mysqli_num_rows($RCTinhoc1);
//lay danh sach tin hoc
$query_RCTinhoc = "SELECT * FROM tlb_tinhoc";
$RCTinhoc = mysqli_query($Myconnection, $query_RCTinhoc) or die(mysqli_error());
$row_RCTinhoc = mysqli_fetch_assoc($RCTinhoc);
$totalRows_RCTinhoc = mysqli_num_rows($RCTinhoc);
//lay dan toc hien tai
$query_RCDantoc1 = "SELECT * FROM tlb_dantoc inner join tlb_congviec on tlb_dantoc.dan_toc_id = tlb_congviec.dan_toc_id where tlb_congviec.ma_nhan_vien = '$ma_nv'";
$RCDantoc1 = mysqli_query($Myconnection, $query_RCDantoc1) or die(mysqli_error());
$row_RCDantoc1 = mysqli_fetch_assoc($RCDantoc1);
$totalRows_RCDantoc1 = mysqli_num_rows($RCDantoc1);
//lay danh sach dan toc
$query_RCDantoc = "SELECT * FROM tlb_dantoc";
$RCDantoc = mysqli_query($Myconnection, $query_RCDantoc) or die(mysqli_error());
$row_RCDantoc = mysqli_fetch_assoc($RCDantoc);
$totalRows_RCDantoc = mysqli_num_rows($RCDantoc);
//Lay quoc tich hien tai
$query_RCQuoctich1 = "SELECT * FROM tlb_quoctich inner join tlb_congviec on tlb_quoctich.quoc_tich_id = tlb_congviec.quoc_tich_id where tlb_congviec.ma_nhan_vien = '$ma_nv'";
$RCQuoctich1 = mysqli_query($Myconnection, $query_RCQuoctich1) or die(mysqli_error());
$row_RCQuoctich1 = mysqli_fetch_assoc($RCQuoctich1);
$totalRows_RCQuoctich1 = mysqli_num_rows($RCQuoctich1);
//Lay danh sach quoc tich
$query_RCQuoctich = "SELECT * FROM tlb_quoctich";
$RCQuoctich = mysqli_query($Myconnection, $query_RCQuoctich) or die(mysqli_error());
$row_RCQuoctich = mysqli_fetch_assoc($RCQuoctich);
$totalRows_RCQuoctich = mysqli_num_rows($RCQuoctich);
//Lay ton giao hien tai
$query_RCTongiao1 = "SELECT * FROM tlb_tongiao inner join tlb_congviec on tlb_tongiao.ton_giao_id = tlb_congviec.ton_giao_id where tlb_congviec.ma_nhan_vien = '$ma_nv'";
$RCTongiao1 = mysqli_query($Myconnection, $query_RCTongiao1) or die(mysqli_error());
$row_RCTongiao1 = mysqli_fetch_assoc($RCTongiao1);
$totalRows_RCTongiao1 = mysqli_num_rows($RCTongiao1);
//Lay danh sach ton giao
$query_RCTongiao = "SELECT * FROM tlb_tongiao";
$RCTongiao = mysqli_query($Myconnection, $query_RCTongiao) or die(mysqli_error());
$row_RCTongiao = mysqli_fetch_assoc($RCTongiao);
$totalRows_RCTongiao = mysqli_num_rows($RCTongiao);
//Lay tinh thanh hien tai
$query_RCTinhthanh1 = "SELECT * FROM tlb_tinhthanh inner join tlb_congviec on tlb_tinhthanh.tinh_thanh_id = tlb_congviec.tinh_thanh_id where tlb_congviec.ma_nhan_vien = '$ma_nv'";
$RCTinhthanh1 = mysqli_query($Myconnection, $query_RCTinhthanh1) or die(mysqli_error());
$row_RCTinhthanh1 = mysqli_fetch_assoc($RCTinhthanh1);
$totalRows_RCTinhthanh1 = mysqli_num_rows($RCTinhthanh1);
//Lay danh sach tinh thanh
$query_RCTinhthanh = "SELECT * FROM tlb_tinhthanh";
$RCTinhthanh = mysqli_query($Myconnection, $query_RCTinhthanh) or die(mysqli_error());
$row_RCTinhthanh = mysqli_fetch_assoc($RCTinhthanh);
$totalRows_RCTinhthanh = mysqli_num_rows($RCTinhthanh);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="css/main.css" media="screen">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
    .button1 {
  background-color: #f44336; 
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
  </style></head>

<body text="#000000" link="#CC0000" vlink="#0000CC" alink="#000099">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="row2" width="800" align="center" cellpadding="1" cellspacing="1" style="border: 1px solid black;">
    <tr valign="baseline">
      <td width="102" align="right" nowrap="nowrap">Mã nhân viên:</td>
      <td width="219"><?php echo $row_RCcapnhat_congviec['ma_nhan_vien']; ?></td>
      <td width="110">Tài khoản NH:</td>
      <td width="291"><input type="text" name="tknh" value="<?php echo htmlentities($row_RCcapnhat_congviec['tknh'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ngày vào làm *:</td>
      <td><input type="date" name="ngay_vao_lam" value="<?php echo htmlentities($row_RCcapnhat_congviec['ngay_vao_lam'], ENT_COMPAT, 'utf-8'); ?>" size="25" /></td>
      <td>Ngân hàng:</td>
      <td><input type="text" name="ngan_hang" value="<?php echo htmlentities($row_RCcapnhat_congviec['ngan_hang'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Phòng ban:</td>
      <td><select name="phong_ban_id">
      <option selected="selected" value="<?php echo $row_RCphongban1['phong_ban_id']?>"><?php echo $row_RCphongban1['ten_phong_ban']?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_RCphongban['phong_ban_id']?>"><?php echo $row_RCphongban['ten_phong_ban']?></option>
        <?php
} while ($row_RCphongban = mysqli_fetch_assoc($RCphongban));
?>
      </select></td>
      <td>Học vấn:</td>
      <td><select name="hoc_van_id">
      <option selected="selected" value="<?php echo $row_RCHocvan1['hoc_van_id']?>"><?php echo $row_RCHocvan1['ten_hoc_van']?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_RCHocvan['hoc_van_id']?>"><?php echo $row_RCHocvan['ten_hoc_van']?></option>
        <?php
} while ($row_RCHocvan = mysqli_fetch_assoc($RCHocvan));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Công việc:</td>
      <td><select name="cong_viec_id">
      <option selected="selected" value="<?php echo $row_RCctcongviec1['cong_viec_id']?>"><?php echo $row_RCctcongviec1['ten_cong_viec']?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_RCctcongviec['cong_viec_id']?>"><?php echo $row_RCctcongviec['ten_cong_viec']?></option>
        <?php
} while ($row_RCctcongviec = mysqli_fetch_assoc($RCctcongviec));
?>
      </select></td>
      <td>Bằng cấp:</td>
      <td><select name="bang_cap_id">
      <option selected="selected" value="<?php echo $row_RCBangcap1['bang_cap_id']?>"><?php echo $row_RCBangcap1['ten_bang_cap']?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_RCBangcap['bang_cap_id']?>"><?php echo $row_RCBangcap['ten_bang_cap']?></option>
        <?php
} while ($row_RCBangcap = mysqli_fetch_assoc($RCBangcap));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Chức vụ:</td>
      <td><select name="chuc_vu_id">
      <option selected="selected" value="<?php echo $row_RCChucvu1['chuc_vu_id']?>"><?php echo $row_RCChucvu1['ten_chuc_vu']?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_RCChucvu['chuc_vu_id']?>"><?php echo $row_RCChucvu['ten_chuc_vu']?></option>
        <?php
} while ($row_RCChucvu = mysqli_fetch_assoc($RCChucvu));
?>
      </select></td>
      <td>Ngoại ngữ:</td>
      <td><select name="ngoai_ngu_id">
      <option selected="selected" value="<?php echo $row_RCNgoaingu1['ngoai_ngu_id']?>"><?php echo $row_RCNgoaingu1['ten_ngoai_ngu']?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_RCNgoaingu['ngoai_ngu_id']?>"><?php echo $row_RCNgoaingu['ten_ngoai_ngu']?></option>
        <?php
} while ($row_RCNgoaingu = mysqli_fetch_assoc($RCNgoaingu));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Mức lương:</td>
      <td><input type="text" name="muc_luong_cb" value="<?php echo htmlentities($row_RCcapnhat_congviec['muc_luong_cb'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td>Tin học:</td>
      <td><select name="tin_hoc_id">
      <option selected="selected" value="<?php echo $row_RCTinhoc1['tin_hoc_id']?>"><?php echo $row_RCTinhoc1['ten_tin_hoc']?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_RCTinhoc['tin_hoc_id']?>"><?php echo $row_RCTinhoc['ten_tin_hoc']?></option>
        <?php
} while ($row_RCTinhoc = mysqli_fetch_assoc($RCTinhoc));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Hệ số:</td>
      <td><input type="text" name="he_so" value="<?php echo htmlentities($row_RCcapnhat_congviec['he_so'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td>Dân tộc:</td>
      <td><select name="dan_toc_id">
      <option selected="selected" value="<?php echo $row_RCDantoc1['dan_toc_id']?>"><?php echo $row_RCDantoc1['ten_dan_toc']?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_RCDantoc['dan_toc_id']?>"><?php echo $row_RCDantoc['ten_dan_toc']?></option>
        <?php
} while ($row_RCDantoc = mysqli_fetch_assoc($RCDantoc));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Phụ cấp:</td>
      <td><input type="text" name="phu_cap" value="<?php echo htmlentities($row_RCcapnhat_congviec['phu_cap'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td>Quốc tịch:</td>
      <td><select name="quoc_tich_id">
      <option selected="selected" value="<?php echo $row_RCQuoctich1['quoc_tich_id']?>"><?php echo $row_RCQuoctich1['ten_quoc_tich']?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_RCQuoctich['quoc_tich_id']?>"><?php echo $row_RCQuoctich['ten_quoc_tich']?></option>
        <?php
} while ($row_RCQuoctich = mysqli_fetch_assoc($RCQuoctich));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Số sổ lao động:</td>
      <td><input type="text" name="so_sld" value="<?php echo htmlentities($row_RCcapnhat_congviec['so_sld'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td>Tôn giáo:</td>
      <td><select name="ton_giao_id">
      <option selected="selected" value="<?php echo $row_RCTongiao1['ton_giao_id']?>"><?php echo $row_RCTongiao1['ten_ton_giao']?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_RCTongiao['ton_giao_id']?>"><?php echo $row_RCTongiao['ten_ton_giao']?></option>
        <?php
} while ($row_RCTongiao = mysqli_fetch_assoc($RCTongiao));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ngày cấp:</td>
      <td><input type="date" name="ngay_cap" value="<?php echo htmlentities($row_RCcapnhat_congviec['ngay_cap'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td>Tỉnh thành:</td>
      <td><select name="tinh_thanh_id">
      <option selected="selected" value="<?php echo $row_RCTinhthanh1['tinh_thanh_id']?>"><?php echo $row_RCTinhthanh1['ten_tinh_thanh']?></option>
        <?php 
do {  
?>
        <option value="<?php echo $row_RCTinhthanh['tinh_thanh_id']?>"><?php echo $row_RCTinhthanh['ten_tinh_thanh']?></option>
        <?php
} while ($row_RCTinhthanh = mysqli_fetch_assoc($RCTinhthanh));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nơi cấp:</td>
      <td><input type="text" name="noi_cap" value="<?php echo htmlentities($row_RCcapnhat_congviec['noi_cap'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
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
  <input type="hidden" name="ma_nhan_vien" value="<?php echo $row_RCcapnhat_congviec['ma_nhan_vien']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysqli_free_result($RCcapnhat_congviec);
?>
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

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

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

mysqli_select_db($Myconnection, $database_Myconnection);
mysqli_set_charset($Myconnection, 'utf8');
$query_RCtlb_nhanvien = "SELECT * FROM tlb_nhanvien where ma_nhan_vien= '$ma_nv'";
$RCtlb_nhanvien = mysqli_query($Myconnection, $query_RCtlb_nhanvien) or die(mysqli_error());
$row_RCtlb_nhanvien = mysqli_fetch_assoc($RCtlb_nhanvien);
$totalRows_RCtlb_nhanvien = mysqli_num_rows($RCtlb_nhanvien);

mysqli_select_db($Myconnection, $database_Myconnection);
mysqli_set_charset($Myconnection, 'utf8');
$query_RCTTcongviec = "SELECT * FROM tlb_phongban inner join (tlb_ctcongviec inner join (tlb_chucvu inner join (tlb_hocvan inner join (tlb_bangcap inner join (tlb_ngoaingu inner join (tlb_tinhoc inner join (tlb_dantoc inner join (tlb_quoctich inner join (tlb_tongiao inner join (tlb_tinhthanh inner join tlb_congviec on tlb_tinhthanh.tinh_thanh_id = tlb_congviec.tinh_thanh_id) on tlb_tongiao.ton_giao_id = tlb_congviec.ton_giao_id) on tlb_quoctich.quoc_tich_id = tlb_congviec.quoc_tich_id) on tlb_dantoc.dan_toc_id = tlb_congviec.dan_toc_id) on tlb_tinhoc.tin_hoc_id = tlb_congviec.tin_hoc_id) on tlb_ngoaingu.ngoai_ngu_id = tlb_congviec.ngoai_ngu_id) on tlb_bangcap.bang_cap_id =tlb_congviec.bang_cap_id) on tlb_hocvan.hoc_van_id=tlb_congviec.hoc_van_id) on tlb_chucvu.chuc_vu_id=tlb_congviec.chuc_vu_id) on tlb_ctcongviec.cong_viec_id=tlb_congviec.cong_viec_id) on tlb_phongban.phong_ban_id=tlb_congviec.phong_ban_id where tlb_congviec.ma_nhan_vien= '$ma_nv'";
$RCTTcongviec = mysqli_query($Myconnection, $query_RCTTcongviec) or die(mysqli_error());
$row_RCTTcongviec = mysqli_fetch_assoc($RCTTcongviec);
$totalRows_RCTTcongviec = mysqli_num_rows($RCTTcongviec);

mysqli_select_db($Myconnection, $database_Myconnection);
mysqli_set_charset($Myconnection, 'utf8');
$query_RCQuanhe_GD = "SELECT * FROM tlb_quanhegiadinh where ma_nhan_vien= '$ma_nv'";
$RCQuanhe_GD = mysqli_query($Myconnection, $query_RCQuanhe_GD) or die(mysqli_error());
$row_RCQuanhe_GD = mysqli_fetch_assoc($RCQuanhe_GD);
$totalRows_RCQuanhe_GD = mysqli_num_rows($RCQuanhe_GD);

mysqli_select_db($Myconnection, $database_Myconnection);
mysqli_set_charset($Myconnection, 'utf8');
$query_RCBaohiem = "SELECT * FROM tlb_baohiem where ma_nhan_vien= '$ma_nv'";
$RCBaohiem = mysqli_query($Myconnection, $query_RCBaohiem) or die(mysqli_error());
$row_RCBaohiem = mysqli_fetch_assoc($RCBaohiem);
$totalRows_RCBaohiem = mysqli_num_rows($RCBaohiem);

mysqli_select_db($Myconnection, $database_Myconnection);
mysqli_set_charset($Myconnection, 'utf8');
$query_RCHopdong = "SELECT * FROM tlb_hopdong where ma_nhan_vien= '$ma_nv'";
$RCHopdong = mysqli_query($Myconnection, $query_RCHopdong) or die(mysqli_error());
$row_RCHopdong = mysqli_fetch_assoc($RCHopdong);
$totalRows_RCHopdong = mysqli_num_rows($RCHopdong);

mysqli_select_db($Myconnection, $database_Myconnection);
mysqli_set_charset($Myconnection, 'utf8');
$query_RCQuatring_CT = "SELECT * FROM tlb_quatrinhcongtac where ma_nhan_vien= '$ma_nv'";
$RCQuatring_CT = mysqli_query($Myconnection, $query_RCQuatring_CT) or die(mysqli_error());
$row_RCQuatring_CT = mysqli_fetch_assoc($RCQuatring_CT);
$totalRows_RCQuatring_CT = mysqli_num_rows($RCQuatring_CT);

mysqli_select_db($Myconnection, $database_Myconnection);
mysqli_set_charset($Myconnection, 'utf8');
$query_RCQuatrinh_luong = "SELECT * FROM tlb_quatrinhluong where ma_nhan_vien= '$ma_nv'";
$RCQuatrinh_luong = mysqli_query($Myconnection, $query_RCQuatrinh_luong) or die(mysqli_error());
$row_RCQuatrinh_luong = mysqli_fetch_assoc($RCQuatrinh_luong);
$totalRows_RCQuatrinh_luong = mysqli_num_rows($RCQuatrinh_luong);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Chi tiết nhân viên</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	line-height: 1.3;
}

-->
</style></head>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<body text="#000000" link="#CC0000" vlink="#0000CC" alink="#000099">
  <table class="tablebg" align="center" width="900" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td class="row5" align="left" height="50" colspan="4"><h3>Thông tin nhân viên</h3></td>
  </tr>
  <tr>
    <td class="row5" width="214" >Mã Nhân viên: <?php echo $row_RCtlb_nhanvien['ma_nhan_vien']; ?></td>
    <td class="row5" width="208">Họ và tên: <?php echo $row_RCtlb_nhanvien['ho_ten']; ?></td>
    <td class="row5" width="116">Giới tính:
	 <?php 
	if ($row_RCtlb_nhanvien['gioi_tinh']==1) 
	{
		echo "Nam";	
	}
	Else
	{
		Echo "Nữ";
	}
	?>
    </td>
    <td class="row5" width="434">Gia đình:
	 <?php 
	if ($row_RCtlb_nhanvien['gia_dinh']==1) 
	{
		echo "Có gia đình";	
	}
	Else
	{
		echo "Chưa có";
	}
	?>
    </td>
  </tr>
  <tr>
    <td class="row5">Điện thoại DĐ: <?php echo $row_RCtlb_nhanvien['dt_di_dong']; ?></td>
    <td class="row5">Điện thoại nhà: <?php echo $row_RCtlb_nhanvien['dt_nha']; ?></td>
    <td class="row5" colspan="2">Email: <?php echo $row_RCtlb_nhanvien['email']; ?></td>
  </tr>
  <tr>
    <td class="row5">Ngày sinh: <?php echo $row_RCtlb_nhanvien['ngay_sinh']; ?></td>
    <td class="row5">Nơi sinh: <?php echo $row_RCtlb_nhanvien['noi_sinh']; ?></td>
    <td class="row5" colspan="2">Tỉnh thành: <?php echo $row_RCtlb_nhanvien['tinh_thanh']; ?></td>
  </tr>
  <tr>
    <td class="row5">CMND: <?php echo $row_RCtlb_nhanvien['cmnd']; ?></td>
    <td class="row5">Ngày cấp: <?php echo $row_RCtlb_nhanvien['ngay_cap']; ?></td>
    <td class="row5" colspan="2">Nơi cấp: <?php echo $row_RCtlb_nhanvien['noi_cap']; ?></td>
  </tr>
  <tr>
    <td colspan="4" class="row5" >Quê quán: <?php echo $row_RCtlb_nhanvien['que_quan']; ?></td>
  </tr>
  <tr>
    <td colspan="4" class="row5">Thường trú: <?php echo $row_RCtlb_nhanvien['dia_chi']; ?></td>
  </tr>
  <tr>
    <td class="row5" colspan="4">Tạm trú: <?php echo $row_RCtlb_nhanvien['tam_tru']; ?></td>
  </tr>
</table>
<table class="tablebg" align="center" width="900" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td class="row5" align="left"colspan="4"><h3>Thông tin công việc</h3></td>
  </tr>
  <tr>
    <td class="row5" width="260">Ngày vào làm: <?php echo $row_RCTTcongviec['ngay_vao_lam']; ?></td>
    <td colspan="2" class="row5">Phòng ban: <?php echo $row_RCTTcongviec['ten_phong_ban']; ?></td>
    <td class="row5" width="463">Chức vụ: <?php echo $row_RCTTcongviec['ten_chuc_vu']; ?></td>
  </tr>
  <tr>
    <td class="row5">Công việc: <?php echo $row_RCTTcongviec['ten_cong_viec']; ?></td>
    <td width="152" class="row5">Mức lương: <?php echo $row_RCTTcongviec['muc_luong_cb']; ?></td>
    <td width="134" class="row5">Hệ số: <?php echo $row_RCTTcongviec['he_so']; ?></td>
    <td class="row5">Phụ cấp: <?php echo $row_RCTTcongviec['phu_cap']; ?></td>
  </tr>
  <tr>
    <td class="row5">Số sổ LĐ: <?php echo $row_RCTTcongviec['so_sld']; ?></td>
    <td colspan="2" class="row5">Ngày cấp: <?php echo $row_RCTTcongviec['ngay_cap']; ?></td>
    <td class="row5">Nơi cấp: <?php echo $row_RCTTcongviec['noi_cap']; ?></td>
  </tr>
  <tr>
    <td class="row5">Tài khoản NH: <?php echo $row_RCTTcongviec['tknh']; ?></td>
    <td class="row5"colspan="3">Ngân hàng: <?php echo $row_RCTTcongviec['ngan_hang']; ?></td>
  </tr>
  <tr>
    <td class="row5">Học vấn: <?php echo $row_RCTTcongviec['ten_hoc_van']; ?></td>
    <td colspan="2" class="row5">Bằng cấp:<?php echo $row_RCTTcongviec['ten_bang_cap']; ?></td>
    <td class="row5">Ngoại ngữ: <?php echo $row_RCTTcongviec['ten_ngoai_ngu']; ?></td>
  </tr>
  <tr>
    <td class="row5">Tin học: <?php echo $row_RCTTcongviec['ten_tin_hoc']; ?></td>
    <td colspan="2" class="row5">Dân tộc: <?php echo $row_RCTTcongviec['ten_dan_toc']; ?></td>
    <td class="row5">Quốc tịch: <?php echo $row_RCTTcongviec['ten_quoc_tich']; ?></td>
  </tr>
  <tr>
    <td class="row5">Tôn giáo: <?php echo $row_RCTTcongviec['ten_ton_giao']; ?></td>
    <td colspan="2" class="row5">Tỉnh thành: <?php echo $row_RCTTcongviec['ten_tinh_thanh']; ?></td>
    <td class="row5">&nbsp;</td>
  </tr>
  <tr>
    <td class="row5">&nbsp;</td>
    <td colspan="2" class="row5">&nbsp;</td>
    <td class="row5">&nbsp;</td>
  </tr>
</table>
<table class="tablebg" align="center" width="900" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td class="row5" align="left"colspan="3"><h3>Quan hệ gia đình</h3></td>
  </tr>
  <?php do { ?>
    <tr>
      <td width="238" class="row5">Tên người thân: <?php echo $row_RCQuanhe_GD['ten_nguoi_than']; ?></td>
      <td width="204" class="row5">Năm sinh: <?php echo $row_RCQuanhe_GD['nam_sinh']; ?></td>
      <td width="536" class="row5">Quan hệ: <?php echo $row_RCQuanhe_GD['moi_quan_he']; ?></td>
    </tr>
    <tr>
      <td class="row5">Địa chỉ: <?php echo $row_RCQuanhe_GD['dia_chi']; ?></td>
      <td colspan="2" class="row5">Nghề nghiệp: <?php echo $row_RCQuanhe_GD['nghe_nghiep']; ?></td>
    </tr>
    <tr>
      <td colspan="2" class="row5">Điện thoại di động: <?php echo $row_RCQuanhe_GD['dtdd']; ?></td>
      <td class="row5">Điện thoại cơ quan: <?php echo $row_RCQuanhe_GD['dtcq']; ?></td>
    </tr>
    <tr>
      <td colspan="3" class="row5">Nơi làm: <?php echo $row_RCQuanhe_GD['noi_lam']; ?></td>
    </tr>
    <tr>
      <td colspan="3" class="row5"><strong>* Ghi chú:</strong> <?php echo $row_RCQuanhe_GD['ghi_chu']; ?></td>
    </tr>
    <?php } while ($row_RCQuanhe_GD = mysqli_fetch_assoc($RCQuanhe_GD)); ?>
    <?php mysqli_free_result($RCQuanhe_GD); ?>
<tr>
      <td align="left" colspan="3" class="row5"><h3>Bảo hiểm</h3></td>
  </tr>
  <tr>
    <td class="row5">- Số BHXH: <?php echo $row_RCBaohiem['so_bhxh']; ?></td>
    <td class="row5">- Ngày cấp: <?php echo $row_RCBaohiem['ngay_cap_bhxh']; ?></td>
    <td class="row5">- Nơi cấp: <?php echo $row_RCBaohiem['noi_cap_bhxh']; ?></td>
  </tr>
  <tr>
<td class="row5">- Số BHYT: <?php echo $row_RCBaohiem['so_bhyt']; ?></td>
    <td class="row5">- Ngày cấp: <?php echo $row_RCBaohiem['ngay_cap_bhyt']; ?></td>
    <td class="row5">- Nơi cấp: <?php echo $row_RCBaohiem['noi_cap_bhyt']; ?></td>
  </tr>
  <tr>
    <td colspan="3" class="row5"><table class="tablebg" width="899" border="0" cellspacing="1" cellpadding="1">
      <tr>
        <td class="row5" align="left" colspan="5"><h3>Hợp đồng lao động</h3></td>
        </tr>
      <tr>
        <td width="176" class="row5">Số quyết định</td>
        <td width="86" class="row5">Từ ngày</td>
        <td width="86" class="row5">Đến ngày</td>
        <td width="105" class="row5">Loại hợp đồng</td>
        <td width="430" class="row5">Ghi chú</td>
      </tr>
      <?php do { ?>
        <tr>
          <td class="row5" width="176"><?php echo $row_RCHopdong['so_quyet_dinh']; ?></td>
          <td class="row5" width="86"><?php echo $row_RCHopdong['tu_ngay']; ?></td>
          <td class="row5" width="86"><?php echo $row_RCHopdong['den_ngay']; ?></td>
          <td class="row5" width="105"><?php echo $row_RCHopdong['loai_hop_dong']; ?></td>
          <td class="row5"><?php echo $row_RCHopdong['ghi_chu']; ?></td>
        </tr>
        <?php } while ($row_RCHopdong = mysqli_fetch_assoc($RCHopdong)); ?>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" class="row5"><table class="tablebg" width="899" border="0" cellspacing="1" cellpadding="1">
      <tr>
        <td class="row5" align="left" colspan="5"><h3>Quá trình công tác</h3></td>
        </tr>
      <tr>
        <td class="row5">Số quyết định</td>
        <td class="row5">Ngày hiệu lực</td>
        <td class="row5">Ngày ký</td>
        <td class="row5">Công việc</td>
        <td width="391" class="row5">Ghi chú</td>
      </tr>
      <?php do { ?>
        <tr>
          <td class="row5" width="156"><?php echo $row_RCQuatring_CT['so_quyet_dinh']; ?></td>
          <td class="row5" width="96"><?php echo $row_RCQuatring_CT['ngay_hieu_luc']; ?></td>
          <td class="row5" width="94"><?php echo $row_RCQuatring_CT['ngay_ky']; ?></td>
          <td class="row5" width="146"><?php echo $row_RCQuatring_CT['cong_viec']; ?></td>
          <td class="row5"><?php echo $row_RCQuatring_CT['ghi_chu']; ?></td>
        </tr>
        <?php } while ($row_RCQuatring_CT = mysqli_fetch_assoc($RCQuatring_CT)); ?>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" class="row5"><table class="tablebg" width="899" border="0" cellspacing="1" cellpadding="1">
      <tr>
        <td class="row5" align="left" colspan="4"><h3>Quá trình lương</h3></td>
        </tr>
      <tr>
        <td class="row5">Số quyết định</td>
        <td class="row5">Ngày chuyển</td>
        <td class="row5">Mức lương</td>
        <td class="row5">Ghi chú</td>
        </tr>
      <?php do { ?>
        <tr>
          <td class="row5" width="200"><?php echo $row_RCQuatrinh_luong['so_quyet_dinh']; ?></td>
          <td class="row5" width="100"><?php echo $row_RCQuatrinh_luong['ngay_chuyen']; ?></td>
          <td class="row5" width="100"><?php echo $row_RCQuatrinh_luong['muc_luong']; ?></td>
          <td class="row5"><?php echo $row_RCQuatrinh_luong['ghi_chu']; ?></td>
          </tr>
        <?php } while ($row_RCHopdong = mysqli_fetch_assoc($RCHopdong)); ?>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<input type="button" value="In" onclick="window.print()">
</body>
</html>
<?php
mysqli_free_result($RCtlb_nhanvien);

mysqli_free_result($RCTTcongviec);

mysqli_free_result($RCBaohiem);

mysqli_free_result($RCHopdong);

mysqli_free_result($RCQuatring_CT);

mysqli_free_result($RCQuatrinh_luong);

?>

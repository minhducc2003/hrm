<?php require_once('Connections/Myconnection.php'); ?>
<?php
$ma_nv = get_param('catID');
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
  $insertSQL = sprintf("INSERT INTO tlb_congviec (ma_nhan_vien, ngay_vao_lam, phong_ban_id, cong_viec_id, chuc_vu_id, muc_luong_cb, he_so, phu_cap, so_sld, ngay_cap, noi_cap, tknh, ngan_hang, hoc_van_id, bang_cap_id, ngoai_ngu_id, tin_hoc_id, dan_toc_id, quoc_tich_id, ton_giao_id, tinh_thanh_id) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString(get_param('ma_nhan_vien'), "text"),
                       GetSQLValueString(get_param('ngay_vao_lam'), "date"),
                       GetSQLValueString(get_param('phong_ban_id'), "text"),
                       GetSQLValueString(get_param('cong_viec_id'), "text"),
             GetSQLValueString(get_param('chuc_vu_id'), "text"),
                       GetSQLValueString(get_param('muc_luong_cb'), "text"),
                       GetSQLValueString(get_param('he_so'), "text"),
                       GetSQLValueString(get_param('phu_cap'), "text"),
                       GetSQLValueString(get_param('so_sld'), "text"),
                       GetSQLValueString(get_param('ngay_cap'), "date"),
                       GetSQLValueString(get_param('noi_cap'), "text"),
                       GetSQLValueString(get_param('tknh'), "text"),
                       GetSQLValueString(get_param('ngan_hang'), "text"),
                       GetSQLValueString(get_param('hoc_van_id'), "text"),
                       GetSQLValueString(get_param('bang_cap_id'), "text"),
                       GetSQLValueString(get_param('ngoai_ngu_id'), "text"),
                       GetSQLValueString(get_param('tin_hoc_id'), "text"),
                       GetSQLValueString(get_param('dan_toc_id'), "text"),
                       GetSQLValueString(get_param('quoc_tich_id'), "text"),
                       GetSQLValueString(get_param('ton_giao_id'), "text"),
                       GetSQLValueString(get_param('tinh_thanh_id'), "text"));

  mysqli_select_db($Myconnection, $database_Myconnection);
  $Result1 = mysqli_query($Myconnection, $insertSQL);

  $insertGoTo = "danh_sach_nhan_vien.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  //thêm mới công việc xong, chuyển sang trang danh sách nhân viêc
    $url = "index.php";
  location($url);
}

mysqli_select_db($Myconnection, $database_Myconnection);
$query_RCPhongban = "SELECT * FROM tlb_phongban";
$RCPhongban = mysqli_query($Myconnection, $query_RCPhongban) or die(mysqli_error());
$row_RCPhongban = mysqli_fetch_assoc($RCPhongban);
$totalRows_RCPhongban = mysqli_num_rows($RCPhongban);
//Lấy mã nhân viên đưa vào để cập nhật
$query_RCThem_congviec = "SELECT * FROM tlb_nhanvien where ma_nhan_vien= '$ma_nv'";
$RCThem_congviec = mysqli_query($Myconnection, $query_RCThem_congviec) or die(mysqli_error());
$row_RCThem_congviec = mysqli_fetch_assoc($RCThem_congviec);
$totalRows_RCThem_congviec = mysqli_num_rows($RCThem_congviec);
//lay danh sach cong viec khi cap nhat
$query_RCctcongviec = "SELECT * FROM tlb_ctcongviec";
$RCctcongviec = mysqli_query($Myconnection, $query_RCctcongviec) or die(mysqli_error());
$row_RCctcongviec = mysqli_fetch_assoc($RCctcongviec);
$totalRows_RCctcongviec = mysqli_num_rows($RCctcongviec);
// danh sach chuc vu
$query_RCChucvu = "SELECT * FROM tlb_chucvu";
$RCChucvu = mysqli_query($Myconnection, $query_RCChucvu) or die(mysqli_error());
$row_RCChucvu = mysqli_fetch_assoc($RCChucvu);
$totalRows_RCChucvu = mysqli_num_rows($RCChucvu);
//lay danh sach Hoc van
$query_RCHocvan = "SELECT * FROM tlb_hocvan";
$RCHocvan = mysqli_query($Myconnection, $query_RCHocvan) or die(mysqli_error());
$row_RCHocvan = mysqli_fetch_assoc($RCHocvan);
$totalRows_RCHocvan = mysqli_num_rows($RCHocvan);
// lay danh sach bang cap
$query_RCBangcap = "SELECT * FROM tlb_bangcap";
$RCBangcap = mysqli_query($Myconnection, $query_RCBangcap) or die(mysqli_error());
$row_RCBangcap = mysqli_fetch_assoc($RCBangcap);
$totalRows_RCBangcap = mysqli_num_rows($RCBangcap);
//lay danh sach ngoai ngu
$query_RCNgoaingu = "SELECT * FROM tlb_ngoaingu";
$RCNgoaingu = mysqli_query($Myconnection, $query_RCNgoaingu) or die(mysqli_error());
$row_RCNgoaingu = mysqli_fetch_assoc($RCNgoaingu);
$totalRows_RCNgoaingu = mysqli_num_rows($RCNgoaingu);
//lay danh sach tin hoc
$query_RCTinhoc = "SELECT * FROM tlb_tinhoc";
$RCTinhoc = mysqli_query($Myconnection, $query_RCTinhoc) or die(mysqli_error());
$row_RCTinhoc = mysqli_fetch_assoc($RCTinhoc);
$totalRows_RCTinhoc = mysqli_num_rows($RCTinhoc);
//lay danh sach dan toc
$query_RCDantoc = "SELECT * FROM tlb_dantoc";
$RCDantoc = mysqli_query($Myconnection, $query_RCDantoc) or die(mysqli_error());
$row_RCDantoc = mysqli_fetch_assoc($RCDantoc);
$totalRows_RCDantoc = mysqli_num_rows($RCDantoc);
//Lay danh sach quoc tich
$query_RCQuoctich = "SELECT * FROM tlb_quoctich";
$RCQuoctich = mysqli_query($Myconnection, $query_RCQuoctich) or die(mysqli_error());
$row_RCQuoctich = mysqli_fetch_assoc($RCQuoctich);
$totalRows_RCQuoctich = mysqli_num_rows($RCQuoctich);
//Lay danh sach ton giao
$query_RCTongiao = "SELECT * FROM tlb_tongiao";
$RCTongiao = mysqli_query($Myconnection, $query_RCTongiao) or die(mysqli_error());
$row_RCTongiao = mysqli_fetch_assoc($RCTongiao);
$totalRows_RCTongiao = mysqli_num_rows($RCTongiao);
//Lay danh sach tinh thanh
$query_RCTinhthanh = "SELECT * FROM tlb_tinhthanh";
$RCTinhthanh = mysqli_query($Myconnection, $query_RCTinhthanh) or die(mysqli_error());
$row_RCTinhthanh = mysqli_fetch_assoc($RCTinhthanh);
$totalRows_RCTinhthanh = mysqli_num_rows($RCTinhthanh);
?>
<style type="text/css">
  .button1 {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
</style>

<body text="#000000" link="#CC0000" vlink="#0000CC" alink="#000099">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="row2" width="800" align="center" cellpadding="2" cellspacing="2" style="border: 1px solid black;">
    <tr valign="baseline">
      <td width="96" align="right" nowrap="nowrap">Mã nhân viên:</td>
      <td width="259"><input type="text" name="ma_nhan_vien" value="<?php echo $row_RCThem_congviec['ma_nhan_vien']; ?>" readonly="readonly" size="32" /></td>
      <td width="117">Tài khoản NH:</td>
      <td width="300"><input type="text" name="tknh" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ngày vào làm *:</td>
      <td><input type="date" name="ngay_vao_lam" value="" size="25" required="" /></td>
      <td>Ngân hàng:</td>
      <td><input type="text" name="ngan_hang" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Phòng ban:</td>
      <td><select name="phong_ban_id">
        <?php 
do {  
?>
        <option value="<?php echo $row_RCPhongban['phong_ban_id']?>"><?php echo $row_RCPhongban['ten_phong_ban']?></option>
        <?php
} while ($row_RCPhongban = mysqli_fetch_assoc($RCPhongban));
?>
      </select></td>
      <td>Học vấn:</td>
      <td><select name="hoc_van_id">
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
      <td nowrap="nowrap" align="right">Mức lương :</td>
      <td><input type="text" name="muc_luong_cb" value="" size="32" /></td>
      <td>Tin học:</td>
      <td><select name="tin_hoc_id">
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
      <td><input type="text" name="he_so" value="" size="32" /></td>
      <td>Dân tộc:</td>
      <td><select name="dan_toc_id">
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
      <td><input type="text" name="phu_cap" value="" size="32" /></td>
      <td>Quốc tịch:</td>
      <td><select name="quoc_tich_id">
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
      <td><input type="text" name="so_sld" value="" size="32" /></td>
      <td>Tôn giáo:</td>
      <td><select name="ton_giao_id">
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
      <td><input type="text" name="ngay_cap" value="" size="32" /></td>
      <td>Tỉnh thành:</td>
      <td><select name="tinh_thanh_id">
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
      <td><input type="text" name="noi_cap" value="" size="32" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="4" align="center" nowrap="nowrap"><input type="submit" class="button1" value="Thêm hồ sơ" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysqli_free_result($RCPhongban);
?>

<?php
$quyen = "SELECT quyen_them, quyen_sua, quyen_xoa FROM tlb_nguoidung WHERE ten_dang_nhap = '".$_SESSION['user_name']."'";
$resultQuyen = mysqli_query($Myconnection, $quyen);
$rowQuyen = mysqli_fetch_array($resultQuyen);
$quyenThem = $rowQuyen['quyen_them'];
$quyenSua = $rowQuyen['quyen_sua'];
$quyenXoa = $rowQuyen['quyen_xoa'];

$keyword = get_param('keyword');
mysqli_select_db($Myconnection, $database_Myconnection);
mysqli_set_charset($Myconnection, 'utf8');
//dem so nhan vien
$nhanVien = "SELECT count(ma_nhan_vien) as tong_nhan_vien FROM tlb_congviec WHERE phong_ban_id = phong_ban_id";
$resultNhanVien = mysqli_query($Myconnection, $nhanVien);
$rowNhanVien = mysqli_fetch_array($resultNhanVien);
$tongNhanVien = $rowNhanVien['tong_nhan_vien'];
//tim nhan vien
$query_RCdanh_sach = "SELECT * FROM tlb_nhanvien";
if($keyword!=''){
	$query_RCdanh_sach .= " Where ho_ten like '%".$keyword."%'";
}

$RCdanh_sach = mysqli_query($Myconnection, $query_RCdanh_sach) or die(mysqli_error());
$row_RCdanh_sach = mysqli_fetch_assoc($RCdanh_sach);
$totalRows_RCdanh_sach = mysqli_num_rows($RCdanh_sach);


if(isset($_GET['ma_phong']))
{
  $ma_phong = $_GET['ma_phong'];

  // lay nhan vien thuoc phong ban
  $nhanVien  = "SELECT nv.ma_nhan_vien as ma_nhan_vien, ho_ten FROM tlb_nhanvien nv, tlb_congviec cv WHERE nv.ma_nhan_vien = cv.ma_nhan_vien AND phong_ban_id = '$ma_phong'";
  $resultNhanVien = mysqli_query($Myconnection, $nhanVien);
  $arrNhanVien = array();
  while ($rowNhanVien = mysqli_fetch_array($resultNhanVien)) 
  {
    $arrNhanVien[] = $rowNhanVien;  
  } 
  
}

?>
<div style="padding:10px; text-align:right;">
<form name="fsearch">
</form>
</div>
<table border="1" width="800" align="center" cellpadding="1" cellspacing="1">
  <tr align="center" style="background-color: black;color: white;">
    <th>MÃ NV</th>
    <th>HỌ VÀ TÊN</th>
    <th>ĐT DI ĐỘNG</th>
    <th>ĐT NHÀ</th>
    <th>EMAIL</th>
    <th> THÔNG TIN</th>
    <th>Công việc</th>
  </tr>
  <?php 

  foreach ($arrNhanVien as $nv) 
  {

  ?>
    <tr align="center">
      <td width="100"><a href="chi_tiet_nhan_vien.php?catID=<?php echo $nv['ma_nhan_vien']; ?>"><?php echo $nv['ma_nhan_vien']; ?></a></td>
      <td><?php echo $nv['ho_ten']; ?></td>
      <td><?php echo $row_RCdanh_sach['dt_di_dong']; ?></td>
      <td><?php echo $row_RCdanh_sach['dt_nha']; ?></td>
      <td><?php echo $row_RCdanh_sach['email']; ?></td>
      <td>
        <?php
        if($quyenThem == 1 || $quyenSua == 1 || $quyenXoa == 1)
        {
          echo "<a href='index.php?require=cap_nhat_thong_tin_nhan_vien.php&catID=".$row_RCdanh_sach['ma_nhan_vien']. "&title=Thông tin nhân viên'>Xem chi tiết</a>";
        }
        else
        {
          echo "<button type='submit' disabled>XemCTNV</button>";
        }
        ?>
      </td>
      <td>
        <?php
      if($quyenThem == 1 || $quyenSua == 1 || $quyenXoa == 1)
      {
      echo "<a href='index.php?require=cap_nhat_thong_tin_cong_viec.php&catID=".$row_RCdanh_sach['ma_nhan_vien']."&title=Thông tin công việc'>Xem chi tiết</a>";
      }
      else
      {
        echo "<button type='submit' disabled>XemCTCV</button>";
      }
      ?>
      </td>
    </tr>
  <?php 
  } 
  ?>
</table>
<?php
mysqli_free_result($RCdanh_sach);
?>

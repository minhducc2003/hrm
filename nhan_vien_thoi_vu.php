<?php require_once('Connections/Myconnection.php'); ?>
<?php 
if ( !isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
  header('Location: dang_nhap.php');
  exit;
}
require_once('tim_phan_quyen.php');

mysqli_select_db($Myconnection, $database_Myconnection);
mysqli_set_charset($Myconnection, 'utf8');
$nv_thoivu = "SELECT nv.ma_nhan_vien as ma_nhan_vien, ho_ten, dt_di_dong, hinh_anh, email FROM tlb_nhanvien nv, tlb_congviec cv WHERE nv.ma_nhan_vien = cv.ma_nhan_vien && chuc_vu_id = 'NV002'";
$result = mysqli_query($Myconnection, $nv_thoivu);
$rowResult = mysqli_fetch_assoc($result);

?>
<link rel="stylesheet" type="text/css" href="css/main.css" media="screen">
<table class="tablebg" border="1" width="900" align="center" cellpadding="1" cellspacing="1">
    <tr align="center" style="background-color: black;color: white;">
    <th>MÃ NV</th>
    <th>HÌNH ẢNH</th>
    <th>HỌ VÀ TÊN</th>
    <th>ĐT DI ĐỘNG</th>
    <th>EMAIL</th>
    <th>THÔNG TIN</th>
    <th>CÔNG VIỆC</th>
  </tr> 
  <?php do { ?>
    <tr align="center">
      <td width="100" align="center"><a href="chi_tiet_nhan_vien.php?catID=<?php echo $row_RCdanh_sach['ma_nhan_vien']; ?>"><?php echo $rowResult['ma_nhan_vien']; ?></a></td>
      <td  class="row1" align="center"><img src="images/<?php echo $rowResult['hinh_anh']; ?>" width="120" height="130" align="top" /></td>
      <td  class="row1" align="center"><?php echo $rowResult['ho_ten']; ?></td>
      <td  class="row1" align="center"><?php echo $rowResult['dt_di_dong']; ?></td>
      <td  class="row1" align="center"><?php echo $rowResult['email']; ?></td>
      <td class="row1" width="113" align="center" >
        <?php
        if($quyenThem == 1 || $quyenSua == 1)
        {
          echo "<a href='index.php?require=cap_nhat_thong_tin_nhan_vien.php&catID=".$rowResult['ma_nhan_vien']. "&title=Thông tin nhân viên'>Xem chi tiết</a>";
        }
        else
        {
          echo "<button type='submit' disabled>XemCTNV</button>";
        }
        ?>
      </td>
      <td class="row1" width="113" align="center" >
      <?php
      if($quyenThem == 1 || $quyenSua == 1)
      {
      echo "<a href='index.php?require=cap_nhat_thong_tin_cong_viec.php&catID=".$rowResult['ma_nhan_vien']. "&title=Thông tin công việc'>Xem chi tiết</a>";
      }
      else
      {
        echo "<button type='submit' disabled>XemCTCV</button>";
      }
      ?>
      </td>
    </tr>
    <?php } while ($rowResult = mysqli_fetch_assoc($result)); ?>
</table>
<?php
mysqli_free_result($result);
?>
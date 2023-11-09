<?php
if ( !isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
  header('Location: dang_nhap.php');
  exit;
}
require_once('tim_phan_quyen.php');

$keyword = get_param('keyword');
mysqli_select_db($Myconnection, $database_Myconnection);
mysqli_set_charset($Myconnection, 'utf8');
//tong nhan vien
$sv = "SELECT count(ma_nhan_vien) as TONG FROM tlb_nhanvien";
$thuchien_sv = mysqli_query($Myconnection, $sv);
$row_sv = mysqli_fetch_array($thuchien_sv);
$tong_sv = $row_sv['TONG'];
//tong nhan vien nghi
$nvNghi = "SELECT count(ma_nhan_vien) as TONGNGHI FROM tlb_nhanvien where nghi_viec =1";
$thuchien_nvNghi = mysqli_query($Myconnection, $nvNghi);
$row_nvNghi = mysqli_fetch_array($thuchien_nvNghi);
$tong_nvNghi = $row_nvNghi['TONGNGHI'];

//tong phong ban
$pb = "SELECT count(phong_ban_id) as TONGPB FROM tlb_phongban";
$thuchien_pb = mysqli_query($Myconnection, $pb);
$row_pb = mysqli_fetch_array($thuchien_pb);
$tong_pb = $row_pb['TONGPB'];
//tim nhan vien
$query_RCdanh_sach = "SELECT * FROM tlb_nhanvien";
if($keyword!=''){
	$query_RCdanh_sach .= " Where ho_ten like '%".$keyword."%' || cmnd like '%".$keyword."%' || ma_nhan_vien like '%".$keyword."%' || dt_di_dong like '%".$keyword."%' || email like '%".$keyword."%'";
}

$RCdanh_sach = mysqli_query($Myconnection, $query_RCdanh_sach);
$row_RCdanh_sach = mysqli_fetch_assoc($RCdanh_sach);
$totalRows_RCdanh_sach = mysqli_num_rows($RCdanh_sach);

?>

<head>
  <script type="text/javascript">
 
         function testConfirmDialog()  {
 
              var result = confirm("Do you want to continue?");
 
              if(result)  {
                  alert("OK Next lesson!");
              } else {
                  alert("Bye!");
              }
         }
 
      </script>
</head>
<?php
if($keyword!=''){
	echo '<div><span class="badge badge-success">Kết quả tìm kiếm nhân viên với từ khóa <b>"'.$keyword.'"</b></div></span>';
}
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css" media="screen">
<table border="1" width="900" align="center" cellpadding="1" cellspacing="1" style="border: 1px solid #7d6632;">
  <tr align="center" style="background-color: #160e1e;color: white;">
    <th>MÃ NV</th>
    <th>HÌNH ẢNH</th>
    <th>HỌ VÀ TÊN</th>
    <th>ĐT DI ĐỘNG</th>
    <th>TÌNH TRẠNG</th>
    <th>THÔNG TIN</th>
    <th>CÔNG VIỆC</th>
    <th>XÓA</th>
    
  </tr> 
  <?php do { ?>
    <tr align="center">
      <td width="100" align="center"><a href="chi_tiet_nhan_vien.php?catID=<?php echo $row_RCdanh_sach['ma_nhan_vien']; ?>"><?php echo $row_RCdanh_sach['ma_nhan_vien']; ?></a></td>
      <td align="center"><img src="images/<?php echo $row_RCdanh_sach['hinh_anh']; ?>" width="120" height="130" align="top" /></td>
      <td align="center"><?php echo $row_RCdanh_sach['ho_ten']; ?></td>
      <td align="center"><?php echo $row_RCdanh_sach['dt_di_dong']; ?></td>
      <td align="center">
        <?php if($row_RCdanh_sach['nghi_viec'] == 1)
      {
        $nghiviec = "<span class='badge badge-danger'>Nghĩ việc</span>";
      }
      else
      {
        $nghiviec = "<span class='badge badge-success''>Đang làm việc</span>";
      } ?>
        <?php echo $nghiviec; ?></td>
      <td class="row1" width="113" align="center" >
        <?php
        if($quyenThem == 1 || $quyenSua == 1)
        {
          echo "<a href='index.php?require=cap_nhat_thong_tin_nhan_vien.php&catID=".$row_RCdanh_sach['ma_nhan_vien']. "&title=Thông tin nhân viên'><span class='badge badge-dark'>Xem chi tiết</span></a>";
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
      echo "<a href='index.php?require=cap_nhat_thong_tin_cong_viec.php&catID=".$row_RCdanh_sach['ma_nhan_vien']. "&title=Thông tin công việc'><span class='badge badge-dark'>Xem chi tiết</span></a>";
      }
      else
      {
        echo "<button type='submit' disabled>XemCTCV</button>";
      }
      ?>
      </td>
      <td>
        <?php 
          if ($quyenXoa == 1) {
        ?>
        <a href='index.php?require=xoa_nhan_vien.php&table=tlb_nhanvien&table=tlb_congviec &catID=<?php echo $row_RCdanh_sach['ma_nhan_vien'];?>' onclick="return confirm('Bạn có chắc chắn xóa không ?')"><span class="badge badge-danger">Xóa</span></a>
        
      <?php } else { ?>
          <button type="button" class="btn btn-danger" disabled="">Xóa</button>
      <?php } ?>

      </td>
    </tr>
    <?php } while ($row_RCdanh_sach = mysqli_fetch_assoc($RCdanh_sach)); ?>
</table>

<?php
mysqli_free_result($RCdanh_sach);
?>

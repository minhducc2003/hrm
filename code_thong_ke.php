<head>
	<title>Thống kê</title>
</head>
<?php
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

//tong nhan vien dang lam viec
$nvLam = "SELECT count(ma_nhan_vien) as TONGLAM FROM tlb_nhanvien where nghi_viec =0";
$thuchien_nvLam = mysqli_query($Myconnection, $nvLam);
$row_nvLam = mysqli_fetch_array($thuchien_nvLam);
$tong_nvLam = $row_nvLam['TONGLAM'];

//tong nhan vien thoi vu
$nvtv = "SELECT count(ma_nhan_vien) as TONGTV FROM tlb_congviec WHERE chuc_vu_id = 'NV002'";
$thuchien_nvtv = mysqli_query($Myconnection, $nvtv);
$row_nvtv = mysqli_fetch_array($thuchien_nvtv);
$tong_nvtv = $row_nvtv['TONGTV'];

//tong phong ban
$pb = "SELECT count(phong_ban_id) as TONGPB FROM tlb_phongban";
$thuchien_pb = mysqli_query($Myconnection, $pb);
$row_pb = mysqli_fetch_array($thuchien_pb);
$tong_pb = $row_pb['TONGPB'];

?>
<?php 
require_once('include/function.php');
require_once('tim_phan_quyen.php');
require_once('Connections/Myconnection.php');
if ( !isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
  header('Location: dang_nhap.php');
  exit;
}
$title = get_param('title');
if ($title == "") $title = 'Danh sách nhân viên công ty';

$quyen = "SELECT ten_dang_nhap FROM tlb_nguoidung WHERE ten_dang_nhap = '".$_SESSION['user_name']."'";
$resultQuyen = mysqli_query($Myconnection, $quyen);
$rowQuyen = mysqli_fetch_array($resultQuyen);
$quantri = $rowQuyen['ten_dang_nhap'];
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/main.css" media="screen">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ADMIN</title>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

  
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-block">
              <div class="inner">
                <h3><?php echo $tong_sv; ?></h3>
                <p>Nhân viên</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="index.php?require=danh_sach_nhan_vien.php&title=Danh sách nhân viên" class="small-box-footer">Xem <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $tong_pb; ?></h3>
                <p>Phòng ban</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="index.php?require=them_danh_muc.php&table=tlb_phongban&title=Phòng ban&column=phong_ban&action=new" class="small-box-footer">Xem <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $tong_nvLam; ?></h3>
                <p>Đang làm</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="index.php?require=nhan_vien_dang_lam_viec.php&title=Danh sách nhân viên còn làm việc" class="small-box-footer">Xem <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $tong_nvtv; ?></h3>
                <p>Thời vụ</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="index.php?require=nhan_vien_thoi_vu.php&title=Danh sách nhân viên thời vụ" class="small-box-footer">Xem <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

        <!-- Small boxes (Stat box) -->
        <div class="row">
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $tong_nvNghi; ?></h3>
                <p>Nghĩ việc</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="index.php?require=danh_sach_nhan_vien_nghi.php&title=Danh sách nhân viên nghĩ việc" class="small-box-footer">Xem <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          
        
        </div>
        

        

</body>
</html>

<?php 
require_once('include/function.php');
require_once('tim_phan_quyen.php');
require_once('Connections/Myconnection.php');
if ( !isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
  header('Location: dang_nhap.php');
  exit;
}

$title = get_param('title');
if ($title == "") $title = 'Danh sách nhân viên';

$quyen = "SELECT ten_dang_nhap FROM tlb_nguoidung WHERE ten_dang_nhap = '".$_SESSION['user_name']."'";
$resultQuyen = mysqli_query($Myconnection, $quyen);
$rowQuyen = mysqli_fetch_array($resultQuyen);
$quantri = $rowQuyen['ten_dang_nhap'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Quản lý nhân sự - CTY TNHH DV QC TRẦN AN</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Trang chủ</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Liên hệ</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3" name="fsearch">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="text" placeholder="Search" aria-label="Search" name="keyword">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
   
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          Xin chào: <?php echo $_SESSION['user_name'] ?> <br>
          <?php if($quyenThem == 1 && $quyenXoa == 1 & $quyenSua == 1){
            echo "Bạn đăng nhập với quyền cao nhất";
          }
          
          ?>
        </div>
      </div>

          <div class="dropdown-divider"></div>
          <a href="index.php?require=doi_user.php&title=Đổi người dùng" class="dropdown-item">
            <i class="fas fa-user-cog"></i> Đổi User
          </a>
          <div class="dropdown-divider"></div>
          <a href="dang_xuat.php" class="dropdown-item">
           <i class="fas fa-sign-out-alt"></i> Đăng xuất
          </a>
          
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">QCTRANAN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <li class="nav-item">
            <a href="index.php?require=them_moi_nhan_vien.php&title=Thêm mới nhân viên" class="nav-link">
              <i class="fa fa-plus" aria-hidden="true"></i>
              <p>
                Thêm nhân viên
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?require=code_thong_ke.php&title=Thống kê" class="nav-link">
             <i class="fas fa-chart-bar"></i>
              <p>
                Thống kê
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?require=ngay_cong.php&title=Chấm công" class="nav-link">
              <p>
                Chấm công
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-users"></i>
              <p>
                Người dùng
                <i class="fas fa-angle-left right"></i>
               
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?require=them_nguoi_dung.php&title=Người dùng" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?require=doi_user.php&title=Đổi người dùng" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Đổi Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="dang_xuat.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Đăng xuất</p>
                </a>
              </li>
              
            </ul>
          </li>
          
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-arrow-circle-down"></i>
              <p>
                Tools
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="export-nhan-vien.php" class="nav-link"><i class="far fa-circle nav-icon"></i>BC danh sách nhân viên</a>
              </li>
              <li class="nav-item">
                <a href="export-nhan-vien-thoi-vu.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>NV thời vụ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="export-nhan-vien-phong-ban-KG.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nhân viên phòng KG</p>
                </a>
            </ul>
          </li>
            
          <li class="nav-header">QUẢN LÝ</li>
          <li class="nav-item has-treeview menu-open">
            <li class="nav-item">
            <a href="index.php?require=quan_ly_anh.php&title=Quản lý ảnh" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>Quản lý ảnh</p>
            </a>
          </li>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-portrait"></i>
              <p>
                Nhân viên
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="index.php?require=danh_sach_nhan_vien.php&title=Danh sách nhân viên" class="nav-link">
              <i class="fas fa-clipboard-list"></i>
              <p>
                DS nhân viên
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?require=nhan_vien_dang_lam_viec.php&title=Danh sách nhân viên còn làm việc" class="nav-link">
              <i class="fas fa-clipboard-list"></i>
              <p>
                DSNV còn làm việc
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?require=danh_sach_nhan_vien_nghi.php&title=Danh sách nhân viên nghĩ" class="nav-link">
              <i class="fas fa-clipboard-list"></i>
              <p>
                DSNV nghĩ việc
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?require=nhan_vien_thoi_vu.php&title=Danh sách nhân viên thời vụ" class="nav-link">
              <i class="fas fa-clipboard-list"></i>
              <p>
                DSNV thời vụ
              </p>
            </a>
          </li>
        </ul></li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="far fa-copy"></i>
              <p>
                Danh mục
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="index.php?require=them_danh_muc.php&table=tlb_phongban&title=Phòng ban&column=phong_ban&action=new" class="nav-link">
Phòng ban</a></li><li class="nav-item">
                <a href="index.php?require=them_danh_muc.php&table=tlb_ctcongviec&title=Công việc&column=cong_viec&action=new" class="nav-link">
Công việc</a></li><li class="nav-item">
                <a href="index.php?require=them_danh_muc.php&table=tlb_chucvu&title=Chức vụ&column=chuc_vu&action=new" class="nav-link">
Chức vụ</a></li><li class="nav-item">
                <a href="index.php?require=them_danh_muc.php&table=tlb_hocvan&title=Học vấn&column=hoc_van&action=new" class="nav-link">
Học vấn</a></li><li class="nav-item">
                <a href="index.php?require=them_danh_muc.php&table=tlb_bangcap&title=Bằng cấp&column=bang_cap&action=new" class="nav-link">
Bằng cấp</a></li><li class="nav-item">
                <a href="index.php?require=them_danh_muc.php&table=tlb_ngoaingu&title=Ngoại ngữ&column=ngoai_ngu&action=new" class="nav-link">
Ngoại ngữ</a></li><li class="nav-item">
                <a href="index.php?require=them_danh_muc.php&table=tlb_tinhoc&title=Tin học&column=tin_hoc&action=new" class="nav-link">
Tin học</a></li><li class="nav-item">
                <a href="index.php?require=them_danh_muc.php&table=tlb_dantoc&title=Dân tộc&column=dan_toc&action=new" class="nav-link">
Dân tộc</a></li><li class="nav-item">
                <a href="index.php?require=them_danh_muc.php&table=tlb_quoctich&title=Quốc tịch&column=quoc_tich&action=new" class="nav-link">
Quốc tịch</a></li><li class="nav-item">
                <a href="index.php?require=them_danh_muc.php&table=tlb_tongiao&title=Tôn giáo&column=ton_giao&action=new" class="nav-link">
Tôn giáo</a></li><li class="nav-item">
                <a href="index.php?require=them_danh_muc.php&table=tlb_tinhthanh&title=Tỉnh thành&column=tinh_thanh&action=new" class="nav-link">
Tỉnh thành</a></li>
        </ul>
      </nav>
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <img width="1080" height="150" src="image/qlns1.jpg" />
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Main row -->
       <div class="row">
         <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>Thêm nhân viên</h3>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="index.php?require=them_moi_nhan_vien.php&title=Thêm mới nhân viên" class="small-box-footer">Xem <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Chấm công</h3>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="index.php?require=ngay_cong.php&title=Chấm công" class="small-box-footer">Xem <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>DSNV <span class="badge badge-success">Đang làm việc</span></h3>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="index.php?require=nhan_vien_dang_lam_viec.php&title=Nhân viên đang làm việc" class="small-box-footer">Xem <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
          
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
           <td><div class="alert"><?php echo $title; ?></div></td>
         </tr>
         <tr>
           <td>
          <?php
          $require = get_param('require');
      if($require ==""){$require = "danh_sach_nhan_vien.php";}
          require_once $require;?> 
          </td>
         </tr>
  </table>
            
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Dev</b> Huỳnh Tấn Triển
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>

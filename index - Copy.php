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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản lý nhân sự - CTY TNHH MTV DV QC TRẦN AN</title>
<link rel="stylesheet" type="text/css" href="js/superfish/css/superfish.css" media="screen">
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/superfish/js/hoverIntent.js"></script>
<script type="text/javascript" src="js/superfish/js/superfish.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
  .body {
  background: url("image/bg/bg1.jpg") no-repeat fixed center  ;
}
.alert {
  padding: 20px;
  background-color: #045f96; 
  color: white;
  margin-bottom: 5px;
}
</style>
</head>
<body onload="time()" class="body">
<div class="topnav">
  <a class="active" onclick="openNav()" style="background-color: red;">
    <?php if($quantri == ('admin') || $quantri == ('administrator'))
    { ?> 
    <i class="fa fa-star-o" aria-hidden="true"></i>
    <?php } 
    else { ?>
    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
    <?php 
    }
    ?>
    <?php echo $_SESSION['user_name'] ?></a>
<a href="index.php">
          <i class="fa fa-home" aria-hidden="true"></i>Home</a>
    <a href="index.php?require=code_thong_ke.php&title=Thống kê"><i class="fa fa-bar-chart" aria-hidden="true"></i>Thống kê</a>
  <form name="fsearch" class="example">
  <input type="text" name="keyword" placeholder="Search..">
</form>
<a href="index.php?require=quan_ly_anh.php&title=Quản lý ảnh"><i class="fa fa-file-image-o" aria-hidden="true"></i>
Quản lý ảnh</a>
<div class="dropdown">
            <button class="dropbtn"><i class="fa fa-list" aria-hidden="true"></i>
DS Nhân viên
              <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
              <a href="index.php?require=danh_sach_nhan_vien.php&title=Danh sách nhân viên"><i class="fa fa-list-ul" aria-hidden="true"></i>
        Danh sách nhân viên</a>
              <a href="index.php?require=danh_sach_nhan_vien_nghi.php&title=Danh sách nghỉ việc"><i class="fa fa-list-ul" aria-hidden="true"></i>
        Danh sách nghỉ việc</a>
        <a href="index.php?require=nhan_vien_dang_lam_viec.php&title=Nhân viên đang làm việc"><i class="fa fa-list-ul" aria-hidden="true"></i>
        Nhân viên đang làm việc</a>
        <a href="index.php?require=nhan_vien_thoi_vu.php&title=Danh sách nhân viên thời vụ"><i class="fa fa-list-ul" aria-hidden="true"></i>
        Nhân viên thời vụ</a>
            </div>
          </div>
<div class="dropdown">
    <button class="dropbtn"><i class="fa fa-align-justify" aria-hidden="true"></i>
Danh mục <i class="fa fa-caret-down"></i></button>
    <div class="dropdown-content">
      <a href="index.php?require=them_danh_muc.php&table=tlb_phongban&title=Phòng ban&column=phong_ban&action=new"><i class="fa fa-eye" aria-hidden="true"></i>
Phòng ban</a>
                <a href="index.php?require=them_danh_muc.php&table=tlb_ctcongviec&title=Công việc&column=cong_viec&action=new"><i class="fa fa-eye" aria-hidden="true"></i>
Công việc</a>
                <a href="index.php?require=them_danh_muc.php&table=tlb_chucvu&title=Chức vụ&column=chuc_vu&action=new"><i class="fa fa-eye" aria-hidden="true"></i>
Chức vụ</a>
                <a href="index.php?require=them_danh_muc.php&table=tlb_hocvan&title=Học vấn&column=hoc_van&action=new"><i class="fa fa-eye" aria-hidden="true"></i>
Học vấn</a>
                <a href="index.php?require=them_danh_muc.php&table=tlb_bangcap&title=Bằng cấp&column=bang_cap&action=new"><i class="fa fa-eye" aria-hidden="true"></i>
Bằng cấp</a>
                <a href="index.php?require=them_danh_muc.php&table=tlb_ngoaingu&title=Ngoại ngữ&column=ngoai_ngu&action=new"><i class="fa fa-eye" aria-hidden="true"></i>
Ngoại ngữ</a>
                <a href="index.php?require=them_danh_muc.php&table=tlb_tinhoc&title=Tin học&column=tin_hoc&action=new"><i class="fa fa-eye" aria-hidden="true"></i>
Tin học</a>
                <a href="index.php?require=them_danh_muc.php&table=tlb_dantoc&title=Dân tộc&column=dan_toc&action=new"><i class="fa fa-eye" aria-hidden="true"></i>
Dân tộc</a>
                <a href="index.php?require=them_danh_muc.php&table=tlb_quoctich&title=Quốc tịch&column=quoc_tich&action=new"><i class="fa fa-eye" aria-hidden="true"></i>
Quốc tịch</a>
                <a href="index.php?require=them_danh_muc.php&table=tlb_tongiao&title=Tôn giáo&column=ton_giao&action=new"><i class="fa fa-eye" aria-hidden="true"></i>
Tôn giáo</a>
                <a href="index.php?require=them_danh_muc.php&table=tlb_tinhthanh&title=Tỉnh thành&column=tinh_thanh&action=new"><i class="fa fa-eye" aria-hidden="true"></i>
Tỉnh thành</a>
    </div>
  </div>
  <div class="dropdown" style="background-color: green;">
            <button class="dropbtn">Tools
              <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
              <a href="export-nhan-vien.php"><i class="fa fa-download"></i> BC danh sách nhân viên</a>
              <a href="export-nhan-vien-thoi-vu.php"><i class="fa fa-download"></i> BC danh sách nhân viên thời vụ</a>
              <a href="export-nhan-vien-phong-ban-KG.php"><i class="fa fa-download"></i> BC danh sách nhân viên KVKG</a>
            </div>
          </div>
</div>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a>Xin chào:</a>
  <a><i class="fa fa-user" aria-hidden="true"></i>[<?php echo $_SESSION['user_name'] ?>]</a>
<?php if ($_SESSION['user_name'] == 'admin' || $_SESSION['user_name'] == 'administrator') { ?>
 
  <a href="index.php?require=them_nguoi_dung.php&title=Người dùng"><i class="fa fa-users" aria-hidden="true"></i>Users</a>
<?php
}
?>
  <a href="index.php?require=doi_user.php&title=Đổi người dùng"><i class="fa fa-cog" aria-hidden="true"></i>Đổi User</a>
  <a href="dang_xuat.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
Exit</a>
<span style="color: blue;">Today:</span>
          <div id="clock" style="color: white;"></div>
</div>
<div class="wrapper">
<table align="center" width="980" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="2"><img width="100%" height="70%" src="image/qlns1.jpg" /></td>
  </tr>
  <td class="row4" width="170" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="10">
      <tr>
  <td class="row3">

          <div class="vertical-menu">
  <a href="index.php" class="active">
  <i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a>
  <a href="index.php?require=them_moi_nhan_vien.php&title=Thêm mới nhân viên"><i class="fa fa-plus" aria-hidden="true"></i>
Thêm mới nhân viên</a>
  <a href="index.php?require=danh_sach_nhan_vien.php&title=Danh sách nhân viên"><i class="fa fa-list-ul" aria-hidden="true"></i> Danh sách NV</a>
  <a href="index.php?require=danh_sach_nhan_vien_nghi.php&title=Nhân viên nghỉ việc"><i class="fa fa-list-ul" aria-hidden="true"></i> NV nghỉ việc</a>
  <a href="index.php?require=nhan_vien_dang_lam_viec.php&title=Nhân viên đang làm việc"><i class="fa fa-list-ul" aria-hidden="true"></i>
        NV đang làm việc</a>
  <a href="index.php?require=nhan_vien_thoi_vu.php&title=Danh sách nhân viên thời vụ"><i class="fa fa-list-ul" aria-hidden="true"></i>
        NV thời vụ</a>
  <a href="index.php?require=them_danh_muc.php&table=tlb_phongban&title=Phòng%20ban&column=phong_ban&action=new">Phòng ban</a>
  
  <form action="xoa_nhan_vien.php" method="GET" enctype="multipart/form-data">
    <?php if ($quyenXoa == 1) { ?>
    <input type="text" name="MNV" placeholder="Xóa nhân viên"><i class="fa fa-trash" aria-hidden="true"></i>
  <?php } ?>
  </form>
</div>

      </td></tr>
  <tr>
    </table></td>
    <td width="797" valign="top">
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
  </td></tr>
    </table></td>
  </tr>
</table>
</div>
<div style="padding:1px; text-align: center;">
  <h5>Copyright © 2019 Huỳnh Tấn Triển</h5></div>
</body>
</html>

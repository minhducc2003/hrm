<?php
require_once('include/function.php');
require_once('Connections/Myconnection.php');

$submit = get_param('submit');
if($submit<>""){
  $ten_dang_nhap=get_param('ten_dang_nhap');
  $mat_khau=md5(get_param('mat_khau'));
mysqli_select_db($Myconnection, $database_Myconnection);
mysqli_set_charset($Myconnection, 'utf8');
  $query_RCNguoidung = "SELECT * FROM tlb_nguoidung WHERE ten_dang_nhap = '".$ten_dang_nhap."' AND mat_khau = '".$mat_khau."'";
  $RCNguoidung = mysqli_query($Myconnection, $query_RCNguoidung);
  $row_RCNguoidung = mysqli_fetch_assoc($RCNguoidung);
  $totalRows_RCNguoidung = mysqli_num_rows($RCNguoidung);
  mysqli_free_result($RCNguoidung);
  //nếu đăng nhập thành công
  if ($totalRows_RCNguoidung<>0)
  {
    $_SESSION['logged-in'] = true;
    $_SESSION['user_name'] = $ten_dang_nhap;
    $_SESSION['quyen_them'] = true;
    $_SESSION['quyen_sua'] = true;
    $_SESSION['quyen_xoa'] = true;
    echo "Đăng nhập thành công";
    echo '<script type="text/javascript">';
    echo ' alert("Chú ý: Cập nhật thông tin nhân viên và chi tiết công việc.")'; 
    echo '</script>';
    $url = "index.php";
    location($url);
    exit;
    
  }
  else{ 
    echo '<script type="text/javascript">';
    echo ' alert("Sai tên đăng nhập hoặc mật khẩu! Vui lòng nhập lại.")'; 
    echo '</script>';
  }
}
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style type="text/css">
  body {
    font-family: "Lato", sans-serif;
}



.main-head{
    height: 150px;
    background: #FFF;
   
}

.sidenav {
    height: 100%;
    background-color: #000;
    overflow-x: hidden;
    padding-top: 20px;
}


.main {
    padding: 0px 10px;
}

@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
}

@media screen and (max-width: 450px) {
    .login-form{
        margin-top: 10%;
    }

    .register-form{
        margin-top: 10%;
    }
}

@media screen and (min-width: 768px){
    .main{
        margin-left: 40%; 
    }

    .sidenav{
        width: 40%;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
    }

    .login-form{
        margin-top: 80%;
    }

    .register-form{
        margin-top: 20%;
    }
}


.login-main-text{
    margin-top: 20%;
    padding: 60px;
    color: #fff;
}

.login-main-text h2{
    font-weight: 300;
}

.btn-black{
    background-color: #000 !important;
    color: #fff;
}
</style>

<div class="sidenav">
         <div class="login-main-text">
            <h2>QUẢN LÝ NHÂN SỰ</h2>
            <p>Đăng nhập để tiếp tục.</p>
            <h1>CTY TNHH DV QC TRẦN AN</h1>
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
               <form action="dang_nhap.php" method="post">
                  <div class="form-group">
                     <label>Tài khoản</label>
                     <input type="text" class="form-control" placeholder="User Name" name="ten_dang_nhap" required="">
                  </div>
                  <div class="form-group">
                     <label>Mật khẩu</label>
                     <input type="password" class="form-control" placeholder="Password" name="mat_khau" required="">
                  </div>
                  <input type="submit" name="submit" class="btn btn-black" value="ĐĂNG NHẬP">
                  <button type="Reset" class="btn btn-secondary">Nhập lại</button>
               </form>
            </div>
         </div>
      </div>
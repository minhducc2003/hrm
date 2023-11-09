<?php
$hostname_Myconnection = "localhost";
$database_Myconnection = "thuctap_nhansu";
$username_Myconnection = "root";
$password_Myconnection = "";
$Myconnection = mysqli_connect($hostname_Myconnection, $username_Myconnection,'',$database_Myconnection);
mysqli_set_charset($Myconnection, 'utf8');
// cham cong
$datenow = date_format(date_create(date('Y-m-d H:i:s')), "Y-m-d");
$monthnow = date_format(date_create(date('Y-m-d H:i:s')), "m");
$yearnow = date_format(date_create(date('Y-m-d H:i:s')), "Y");



if(isset($_POST['chamcong']))
{
	if($_POST['nhanvien'] != "")
	{
		$ins = "INSERT INTO tlb_chamcong(ma_nhan_vien, ngay_cham, muc_luong) VALUES('".$_POST['nhanvien']."', '".$_POST['ngaycham']."','".$_POST['muc_luong']."')";
		$result = mysqli_query($Myconnection, $ins);
		if($result)
		{
			echo "<script>alert('Chấm công thành công');</script>";
		}
	}else
	{
		echo "<script>alert('Chọn nhân viên chấm công');</script>";
	}
}

if(isset($_POST['tinhcong']))
{
	$manhanvien = $_POST['nhanvien'];
	$thang = $_POST['thang'];
	$nam = $_POST['nam'];

	$tongluong = "SELECT sum(muc_luong) as TONG FROM tlb_chamcong where ma_nhan_vien = '$manhanvien' AND month(ngay_cham)=$thang AND year(ngay_cham) = $nam";
	$thuchien_tongluong = mysqli_query($Myconnection, $tongluong);
	$row_tongluong = mysqli_fetch_array($thuchien_tongluong);
	$tong_luong = $row_tongluong['TONG'];

	if($_POST['nhanvien'] != "")
	{
		$nhanvien = "SELECT nv.ma_nhan_vien as ma_nhan_vien, ho_ten, ngay_cham, id, muc_luong FROM tlb_nhanvien nv, tlb_chamcong cc WHERE nv.ma_nhan_vien = cc.ma_nhan_vien AND month(ngay_cham) = $thang AND year(ngay_cham) = $nam AND nv.ma_nhan_vien = '$manhanvien'";
		$result = mysqli_query($Myconnection, $nhanvien);
		$arrNV = array();
		$songay = mysqli_num_rows($result);
		
		while ($row = mysqli_fetch_array($result)) 
		{
			$arrNV[] = $row;
		}
	}
	else
	{
		echo "<script>alert('Chọn nhân viên chấm công');</script>";
	}

}

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="css/main.css">
<div class="container py-5">
	<h2 align="center"><span class="badge badge-info">CHẤM CÔNG NHÂN VIÊN</span></h2>
	<form action="" method="POST">
		<div class="form-group">
		    <label for="exampleFormControlSelect1"><span class="badge badge-danger">Chọn nhân viên</span></label>
		    <select class="form-control" id="exampleFormControlSelect1" name="nhanvien">
		      <option value="">--- Chọn nhân viên ---</option>
		    <?php 
		    	$query_RCdanh_sach = "SELECT * FROM tlb_nhanvien where nghi_viec = 0";
				$RCdanh_sach = mysqli_query($Myconnection, $query_RCdanh_sach);
				while($row_RCdanh_sach = mysqli_fetch_assoc($RCdanh_sach))
				{
					echo "<option value='".$row_RCdanh_sach['ma_nhan_vien']."'>[".$row_RCdanh_sach['ma_nhan_vien']."] ".$row_RCdanh_sach['ho_ten']."</option>";
				}
		    ?>
		    </select>
	  	</div>
	  	<div class="form-group">
	  		<label for="exampleFormControlSelect1"><span class="badge badge-danger">Ngày chấm</span></label>
	  		<input type="date" name="ngaycham" class="form-control" value="<?php echo $datenow; ?>">
	  		<label for="exampleFormControlSelect1"><span class="badge badge-danger">Mức lương:</span></label>
	  		<input type="text" name="muc_luong" class="form-control" placeholder="VNĐ">
	  	</div>
	  	<?php 
            if ($quyenThem == 1) {
        ?>
	  	<input type="submit" name="chamcong" class="btn btn-primary btn-block" value="XÁC NHẬN">
	  	<?php
	  		}
	  		else { ?>
	  			<input type="submit" name="chamcong" disabled="" class="btn btn-primary btn-block" value="CHẤM CÔNG">
	  <?php } ?>
	</form>
</div>

<div class="container py-2">
	<h2 align="center" class="mt-2"><span class="badge badge-info">Danh sách chấm công nhân viên</span></h2>
	<form action="" method="POST">
		<div class="form-group">
		    <label for="exampleFormControlSelect1"><span class="badge badge-danger">Chọn nhân viên</span></label>
		    <select class="form-control" id="exampleFormControlSelect1" name="nhanvien">
		      <option value="">--- Chọn nhân viên ---</option>
		    <?php 
		    	$query_RCdanh_sach = "SELECT * FROM tlb_nhanvien where nghi_viec = 0";
				$RCdanh_sach = mysqli_query($Myconnection, $query_RCdanh_sach);
				while($row_RCdanh_sach = mysqli_fetch_assoc($RCdanh_sach))
				{
					echo "<option value='".$row_RCdanh_sach['ma_nhan_vien']."'>[".$row_RCdanh_sach['ma_nhan_vien']."] ".$row_RCdanh_sach['ho_ten']."</option>";
				}
		    ?>
		    </select>
	  	</div>
	  	<div class="form-group">
	  		<label for="exampleFormControlSelect1"><span class="badge badge-danger">Tháng: </span></label>
	  		<input type="text" name="thang" value="<?php echo $monthnow; ?>">
	  		<label for="exampleFormControlSelect1"><span class="badge badge-danger">Năm: </span></label>
	  		<input type="text" name="nam" value="<?php echo $yearnow; ?>">
	  	</div>
	  	<input type="submit" name="tinhcong" class="btn btn-primary btn-block" value="TÍNH CÔNG">
	</form>

	<?php 
		if(isset($_POST['tinhcong']) && $_POST['nhanvien'] != "")
		{
	?>
			<span class="badge badge-success">
			  Nhân viên này đã làm được <b style="color: red"><?php echo $songay; ?></b> ngày!
			</span>
			<table class="table table-bordered mt-2">
			  <thead>
			    <tr>
			      <th scope="col">STT</th>
			      <th scope="col">Mã nhân viên</th>
			      <th scope="col">Tên nhân viên</th>
			      <th scope="col">Ngày chấm</th>
			      <th scope="col">Mức lương</th>
			      <th scope="col">Xóa</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php
			  		$stt = 0; 
			  		foreach ($arrNV as $key) 
			  		{
			  			$stt++;
			  	?>
			  			<tr>
					      <th scope="row"><?php echo $stt; ?></th>
					      <td><?php echo $key['ma_nhan_vien']; ?></td>
					      <td><?php echo $key['ho_ten']; ?></td>
					      <td><span class="badge badge-primary"><?php echo date_format(date_create($key['ngay_cham']), "d/m/Y"); ?></span></td>
					      <td><?php echo $key['muc_luong']; ?><b><u>đ</u></b></td>
					      <td>
					      	<?php 
              					if ($quyenXoa == 1) {
              				?>
					      	<a href="index.php?require=xoa_cham_cong.php&table=tlb_chamcong &catID=<?php echo $key['id'];?>"><span class="badge badge-danger" onclick="return confirm('Bạn có chắc chắn xóa không ?')">Xóa</span></a>
					      	<?php } 
            					else { ?>
            						<button type="button" class="btn btn-danger" disabled="">Xóa</button>
            						<?php
						            }
						            ?>
					      </td>

					    </tr>
			  	<?php
			  		}
			  	?>
			    <tr>
			    	<td></td>
			    	<td></td>
			    	<td></td>
			    	<td></td>
			    	<td><b>Tổng lương:</b></td>
			    	<td><?php echo $tong_luong; ?><b><u>đ</u></b></td>
			    </tr>
			  </tbody>
			</table>
	<?php
		}
	?>
</div>
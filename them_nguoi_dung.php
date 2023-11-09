<?php require_once('Connections/Myconnection.php'); ?>
<?php
$title = get_param('title');
$column = get_param('column');
$action = get_param('action');

$quyen = "SELECT ten_dang_nhap FROM tlb_nguoidung WHERE ten_dang_nhap = '".$_SESSION['user_name']."'";
$resultQuyen = mysqli_query($Myconnection, $quyen);
$rowQuyen = mysqli_fetch_array($resultQuyen);
$quantri = $rowQuyen['ten_dang_nhap'];

//Thực hiện lệnh xoá nếu chọn xoá
if ($action=="del")
{
	$ma_nv = $_GET['catID'];
	$ma_column = $column . "id";
	$deleteSQL = "DELETE FROM tlb_nguoidung WHERE $ma_column='$ma_nv'";                     
	
	  mysqli_select_db($Myconnection, $database_Myconnection);
    mysqli_set_charset($Myconnection, 'utf8');
	  $Result1 = mysqli_query($Myconnection, $deleteSQL);
	
	  $deleteGoTo = "them_danh_muc.php";
	  if (isset($_SERVER['QUERY_STRING'])) {
		$deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
		$deleteGoTo .= $_SERVER['QUERY_STRING'];
	  }
	  sprintf("Location: %s", $deleteGoTo);
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$them = get_param('3');if($them=="them"){$them=1;}else{$them=0;}
$sua = get_param('4');if($sua=="sua"){$sua=1;}else{$sua=0;}
$xoa = get_param('5');if($xoa=="xoa"){$xoa=1;}else{$xoa=0;}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tlb_nguoidung(id,ten_dang_nhap, mat_khau, quyen_them, quyen_sua, quyen_xoa) VALUES (NULL,'%s','%s','%s','%s','%s')",get_param('1'),md5(get_param('2')),$them,$sua,$xoa);

mysqli_select_db($Myconnection, $database_Myconnection);
  $Result1 = mysqli_query($Myconnection, $insertSQL);

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="css/main.css" media="screen">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<body text="#000000" link="#CC0000" vlink="#0000CC" alink="#000099">
<table width="800" border="1" cellspacing="1" cellpadding="10" align="center">
  <tr>
    <td class="row2" width="260" align="center" valign="top">
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table width="255" align="center">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Tên <?php echo $title?> :</td>
            <td><input type="text" name="1" value="" size="24" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Mật khẩu:</td>
            <td><input type="password" name="2" value="" size="24" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Quyền hạn:</td>
            <td>Thêm <input type="checkbox" name="3" value="them" /> Sửa <input type="checkbox" value="sua" name="4" /> Xóa <input type="checkbox" value="xoa" name="5" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td>
              <?php 
              if($quantri == ('admin') || $quantri == ('administrator'))
              {
                echo "<input type='submit' class='button1' value='Thêm mới' />";
              }
              else
              {
                echo "<button type='submit' class='button1' disabled>Thêm mới</button>";
              }
            ?>
            </td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
    <p>&nbsp;</p></td>
    <td class="row2" width="500" valign="top"><table width="500" border="1" cellspacing="1" cellpadding="1">
      <tr>
        <th width="25">Stt</th>
        <th width="120">Mã <?php echo $title?></th>
        <th width="230">Tên <?php echo $title?></th>
        <th width="35">X</th>
      </tr>
      <?php 
	  	mysqli_select_db($Myconnection, $database_Myconnection);
		$query_RCDanhmuc_TM = "SELECT id,ten_dang_nhap FROM tlb_nguoidung";
		$RCDanhmuc_TM = mysqli_query($Myconnection, $query_RCDanhmuc_TM);
		$row_RCDanhmuc_TM = mysqli_fetch_assoc($RCDanhmuc_TM);
		$totalRows_RCDanhmuc_TM = mysqli_num_rows($RCDanhmuc_TM);
	  ?>
        <?php 
		$stt =1;
		while ($row = mysqli_fetch_row($RCDanhmuc_TM)) {?>
          <tr>
            <td class="row1"><?php echo $stt;?></td>
            <td class="row1"><?php echo $row[0]; ?></td>
            <td class="row1"><?php echo $row[1]; ?></td>
            <td class="row1">
              <?php
              if($quantri == ('admin') || $quantri == ('administrator'))
              { ?>
                <a href='index.php?require=them_nguoi_dung.php&table=tlb_nguoidung&catID=<?php echo $row[0]; ?>&title=<?php echo $title; ?>&column=<?php echo $column; ?>&action=del' onclick="return confirm('Bạn có chắc chắn xóa không ?')">Xoá</a>
              <?php } 
              else
              {
                echo "<button type='submit' disabled>XX</button>";
              }
              ?>
            </td>
          </tr>
          <?php $stt = $stt + 1; ?>
          <?php }  ?>
    </table></td>
  </tr>
</table>
<p></p>
</html>
<?php
mysqli_free_result($RCDanhmuc_TM);
?>

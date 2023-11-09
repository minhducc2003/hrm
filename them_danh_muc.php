<?php require_once('Connections/Myconnection.php'); 
require_once('tim_phan_quyen.php');

?>
<?php
$table = get_param('table');
$title = get_param('title');
$column = get_param('column');
$action = get_param('action');


//Thực hiện lệnh xoá nếu chọn xoá
if ($action=="del")
{
	$ma_nv = get_param('catID');
	$ma_column = $column . "_id";
	$deleteSQL = "DELETE FROM $table WHERE $ma_column='$ma_nv'";                     
	
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

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  //$theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

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
  $insertSQL = sprintf("INSERT INTO $table VALUES (%s, %s)",
                       GetSQLValueString($_POST['1'], "text"),
                       GetSQLValueString($_POST['2'], "text"));

  mysqli_select_db($Myconnection, $database_Myconnection);
  mysqli_set_charset($Myconnection, 'utf8');
  $Result1 = mysqli_query($Myconnection, $insertSQL);

  $insertGoTo = "them_danh_muc.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  sprintf("Location: %s", $insertGoTo);
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
            <td nowrap="nowrap" align="right">Mã <?php echo $title?> :</td>
            <td><input type="text" class="p_b" name="1" value="" size="24" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Tên <?php echo $title?> :</td>
            <td><input type="text" class="p_b" name="2" value="" size="24" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td>
            <?php 
              if($quyenThem == 1)
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
    <td width="500" valign="top"><table width="500" border="1" cellspacing="1" cellpadding="1">
      <tr align="center" style="background-color: black;color: white;">
        <th>STT</th>
        <th>Mã <?php echo $title?></th>
        <th>Tên <?php echo $title?></th>
        <th>Edit</th>
        <th>X</th>
      </tr>
      <?php 
	  	//mysql_select_db($database_Myconnection, $Myconnection);
 mysqli_select_db($Myconnection, $database_Myconnection);
mysqli_set_charset($Myconnection, 'utf8');
		$query_RCDanhmuc_TM = "SELECT * FROM $table";
		$RCDanhmuc_TM = mysqli_query($Myconnection, $query_RCDanhmuc_TM) or die(mysqli_error());
		//$row_RCDanhmuc_TM = mysql_fetch_assoc($RCDanhmuc_TM);
		$totalRows_RCDanhmuc_TM = mysqli_num_rows($RCDanhmuc_TM);
	  ?>
        <?php 
		$stt =1;
		while ($row = mysqli_fetch_row($RCDanhmuc_TM)) {
      $ma_phong = $row[0];

      // dem so nhan vien
      $nhanVien = "SELECT count(ma_nhan_vien) as tong_nhan_vien FROM tlb_congviec WHERE phong_ban_id = '$ma_phong'";
      $resultNhanVien = mysqli_query($Myconnection, $nhanVien);
      $rowNhanVien = mysqli_fetch_array($resultNhanVien);
      $tongNhanVien = $rowNhanVien['tong_nhan_vien'];
    ?>
          <tr>
            <td><?php echo $stt;?></td>
            <td><?php echo $row[0]; ?></td>
            <td><?php if($table =='tlb_phongban'){ ?><a href="phong-ban-nhan-vien.php?ma_phong=<?php echo $ma_phong; ?>"><?php } ?><?php echo $row[1]; ?><?php if($table == 'tlb_phongban'){ echo "(". $tongNhanVien . " nhân viên)"; } ?></a></td>
            <?php 
              if ($quyenSua ==1) {
              ?>
            <td>
              <a href='index.php?require=cap_nhat_danh_muc.php&table=<?php echo $table; ?>&catID=<?php echo $row[0]; ?>&title=<?php echo $title; ?>&column=<?php echo $column;?>&action=edit'>Sửa</a></td>
              <?php } 
            else { ?>
              <td><input type="button" disabled="" value="XXX"></td>
              
            <?php
            }
            ?>
            <?php 
              if ($quyenXoa ==1) {
              ?>
              <td>
              <a href='index.php?require=them_danh_muc.php&table=<?php echo $table; ?> &catID=<?php echo $row[0];?>&title=<?php echo $title;?> &column=<?php echo $column; ?> &action=del' onclick="return confirm('Bạn có chắc chắn xóa không ?')">Xoá</a></td>
              <?php } 
            else { ?>
              <td><input type="button" disabled="" value="XXX"></td>
              <?php
            }
            ?>
            
              
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

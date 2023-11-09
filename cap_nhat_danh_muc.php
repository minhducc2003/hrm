<?php require_once('Connections/Myconnection.php');
require_once('tim_phan_quyen.php'); ?>
<?php
$table = get_param('table');
$title = get_param('title');
$ma_nv = get_param('catID');
$column = get_param('column');
$ma_column = $column . "_id";
$ten_column = "ten_" . $column;
$action = get_param('action');

//Thực hiện lệnh xoá nếu chọn xoá
if ($action=="del")
{
	$ma_nv = $_GET['catID'];
	$ma_column = $column . "_id";
	$deleteSQL = "DELETE FROM $table WHERE $ma_column='$ma_nv'";                     
	
    mysqli_select_db($Myconnection, $database_Myconnection);
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE $table SET $ten_column=%s WHERE $ma_column=%s",
                       GetSQLValueString($_POST['2'], "text"),
                       GetSQLValueString($_POST['1'], "text"));

  mysqli_select_db($Myconnection, $database_Myconnection);
  mysqli_set_charset($Myconnection, 'utf8');
  $Result1 = mysqli_query($Myconnection, $updateSQL) or die(mysqli_error());

  $updateGoTo = "them_danh_muc.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
 	sprintf("Location: %s", $updateGoTo);
}
mysqli_select_db($Myconnection, $database_Myconnection);
$query_RCDanhmuc_DS = "SELECT * FROM $table";
$RCDanhmuc_DS = mysqli_query($Myconnection, $query_RCDanhmuc_DS) or die(mysqli_error());
$row_RCDanhmuc_DS = mysqli_fetch_assoc($RCDanhmuc_DS);
$totalRows_RCDanhmuc_DS = mysqli_num_rows($RCDanhmuc_DS);
?>
<link rel="stylesheet" type="text/css" href="css/main.css" media="screen">
<table width="800" border="1" cellspacing="1" cellpadding="0" align="center">
  <tr>
    <td width="500" valign="top"><table width="500" border="1" cellspacing="1" cellpadding="1">
      <tr>
        <th>Stt</th>
        <th>Mã <?php echo $title?></th>
        <th>Tên <?php echo $title?></th>
        <th>Add</th>
        <th>Edit</th>
        <th >X</th>
      </tr>
      <?php 
	  $stt = 1;
	  do { ?>
        <tr>
          <td><?php echo $stt; ?></td>
          <td><?php echo $row_RCDanhmuc_DS[$ma_column]; ?></td>
          <td><?php echo $row_RCDanhmuc_DS[$ten_column]; ?></td>
          <?php 
              if ($quyenThem ==1) {
              ?>
          <td>
            <a href="index.php?require=them_danh_muc.php&table=<?php echo $table; ?>&title=<?php echo $title; ?>&column=<?php echo $column; ?>&action=new">Thêm</a></td>
            <?php } 
            else { ?>
              <td><input type="button" disabled="" value="XXX"></td>
            <?php
            }
            ?>
            <?php 
              if ($quyenSua ==1) {
              ?>
          <td>
            <a href="index.php?require=cap_nhat_danh_muc.php&table=<?php echo $table; ?>&catID=<?php echo $row_RCDanhmuc_DS[$ma_column]; ?>&title=<?php echo $title; ?>&column=<?php echo $column; ?>">Sửa</a></td>
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
            <a href="index.php?require=cap_nhat_danh_muc.php&table=<?php echo $table; ?>&catID=<?php echo $row_RCDanhmuc_DS[$ma_column]; ?>&title=<?php echo $title; ?>&column=<?php echo $column; ?>&action=del">Xoá</a></td>
            <?php } 
            else { ?>
              <td><input type="button" disabled="" value="XXX"></td>
            <?php
            }
            ?>
        </tr>
        <?php $stt = $stt + 1; ?>
        <?php } while ($row_RCDanhmuc_DS = mysqli_fetch_assoc($RCDanhmuc_DS)); ?>
    </table></td>
    <td width="260" align="center" valign="top">
    <?php 
	   mysqli_select_db($Myconnection, $database_Myconnection);
		$query_RCDanhmuc_CN = "SELECT * FROM $table where $ma_column = '$ma_nv'";
		$RCDanhmuc_CN = mysqli_query($Myconnection, $query_RCDanhmuc_CN);
		$row_RCDanhmuc_CN = mysqli_fetch_assoc($RCDanhmuc_CN);
		$totalRows_RCDanhmuc_CN = mysqli_num_rows($RCDanhmuc_CN);
	?>
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table width="260" align="center" border="0">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Mã <?php echo $title?> :</td>
            <td><input type="text" class="cndm" name="1" value="<?php echo $row_RCDanhmuc_CN[$ma_column]; ?>" readonly="readonly" size="24" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Tên <?php echo $title?> :</td>
            <td><input type="text" class="cndm" name="2" value="<?php echo $row_RCDanhmuc_CN[$ten_column]; ?>" size="24" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" class="button2" value="Cập nhật" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="form1" />
      </form>
    </td>
  </tr>
</table>
<?php
mysqli_free_result($RCDanhmuc_CN);
mysqli_free_result($RCDanhmuc_DS);
?>

<?php require_once('Connections/Myconnection.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  //$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

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
//define a maxim size for the uploaded images in Kb
 define ("MAX_SIZE","5120"); 

//This function reads the extension of the file. It is used to determine if the file  is an image by checking the extension.
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

//This variable is used as a flag. The value is initialized with 0 (meaning no error  found)  
//and it will be changed to 1 if an errro occures.  
//If the error occures the file will not be uploaded.
 $errors=0;
//checks if the form has been submitted
 if(isset($_POST['Submit'])) 
 {
 	//reads the name of the file the user submitted for uploading
 	$image=$_FILES['image']['name'];
 	//if it is not empty
 	if ($image) 
 	{
 	//get the original name of the file from the clients machine
 		$filename = stripslashes($_FILES['image']['name']);
 	//get the extension of the file in a lower case format
  		$extension = getExtension($filename);
 		$extension = strtolower($extension);
 	//if it is not a known extension, we will suppose it is an error and will not  upload the file,  
	//otherwise we will do more tests
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
 		{
		//print error message
 			echo '<h1>Unknown extension!</h1>';
 			$errors=1;
 		}
 		else
 		{
//get the size of the image in bytes
 //$_FILES['image']['tmp_name'] is the temporary filename of the file
 //in which the uploaded file was stored on the server
 $size=filesize($_FILES['image']['tmp_name']);

//compare the size with the maxim size we defined and print error if bigger
if ($size > MAX_SIZE*1024)
{
	echo '<h1>You have exceeded the size limit!</h1>';
	$errors=1;
}

//we will give an unique name, for example the time in unix time format
$image_name=time().'.'.$extension;
//the new name will be containing the full path where will be stored (images folder)
$newname="images/".$image_name;
//we verify if the image has been uploaded, and print error instead
$copied = copy($_FILES['image']['tmp_name'], $newname);
if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
	$errors=1;
}}}}

//If no errors registred, print the success message
 if(isset($_POST['Submit']) && !$errors) 
 {
 	echo "<h2>Tải ảnh thành công.</h2>";
	$insertSQL = "INSERT INTO tlb_hinhanh (ten_anh) VALUES ('$image_name')";
	mysqli_select_db($Myconnection, $database_Myconnection);
  	$Result1 = mysqli_query($Myconnection, $insertSQL);
 }
 ?>
 <!--next comes the form, you must set the enctype to "multipart/frm-data" and use an input type "file" -->
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link href="css/main.css" rel="stylesheet" type="text/css" />
 <form name="newad" method="post" enctype="multipart/form-data"  action="">
 <table class="row2" align="center">
 	<tr><td><input type="file" name="image"></td></tr>
 	<tr><td><input name="Submit" type="submit" value="Tải ảnh lên"></td></tr>
 </table>
 </form>
 <?php
mysqli_select_db($Myconnection, $database_Myconnection);
$query_RCAnh_DS = "SELECT * FROM tlb_hinhanh";
$RCAnh_DS = mysqli_query($Myconnection, $query_RCAnh_DS);
$totalRows_RCAnh_DS = mysqli_num_rows($RCAnh_DS);
    echo "<table class='row2' align ='center' width='985'";
     echo	"<tr><td colspan='6'><h3>Danh sách ảnh </h3><br /><i>Lưu ý:<br />-Kích thước ảnh phải nhỏ hơn 2mb<br />-Chỉ nhận ảnh đuôi .jpg .jpeg . png .gif</i> <br />Copy tên ảnh Past vào Ô Hình ảnh </td></tr>";
 	$stt = 0;
	while ($row=mysqli_fetch_row($RCAnh_DS))
	{
		$hinh_anh = $row[1];
		if ($stt%6 ==0)
		{echo "<tr>";}
		echo "<td valign='top'>";
  		echo "<table align ='center' border='1' cellspacing='0' cellpadding='0'>";
        echo   "<tr> <td class='row1'>$hinh_anh</td></tr>";
        echo    "<tr><td class='row1'><img src=images/$hinh_anh width='120' height='130' align='top'/></td></tr>";
        echo "</table>";
         echo "</td>";
		 $stt = $stt +1;
		 if ($stt%6 ==0)
		{echo "</tr>";}
     } 
     echo "</table>";
mysqli_free_result($RCAnh_DS);
?>
 
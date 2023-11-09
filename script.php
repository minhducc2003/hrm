<?php
// Code by KhoiNguonIT.com
if($_FILES['file'])
{
	$path = './';
	if(!is_dir($path."upload"))
	{
		mkdir($path."upload");
		chmod($path."upload",0775);
	}
	else
		//echo "Thu muc da ton tai";
	
	$max_image_width = 3000;
	$max_image_height = 3000;
	$max_image_size = 2000000;
	
	$f = 'file';
	$image_size = getimagesize($_FILES["$f"]["tmp_name"]);
	
	if($_FILES["$f"]["tmp_name"] == "")
	{
		echo "Ban chua chon file ";
	}
	else if($image_size[0] > $max_image_width || $image_size[1] > $max_image_height)
	{
		echo "Kich thuoc hinh lon hon quy dinh " . $max_image_width . " x " . $max_image_height . "px";
	}
	
	else if ((($_FILES["$f"]["type"] == "image/gif")
	|| ($_FILES["$f"]["type"] == "image/jpeg")
	|| ($_FILES["$f"]["type"] == "image/png")
	|| ($_FILES["$f"]["type"] == "image/pjpeg"))
	&& ($_FILES["$f"]["size"] < $max_image_size))
	{
		if ($_FILES["$f"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["$f"]["error"] . "<br />";
		}
		else
		{
			echo "Upload: " . $_FILES["$f"]["name"] . "<br />";
			echo "Type: " . $_FILES["$f"]["type"] . "<br />";
			echo "Size: " . ($_FILES["$f"]["size"] / 1024) . " Kb<br />";
			$fileName = $_FILES["$f"]["name"];
			$now = date("Ymd-His");
			$newFileName = $now . "-" . $fileName;
			if (file_exists("upload/" . $_FILES["$f"]["name"]))
			{
				echo $_FILES["$f"]["name"] . " already exists. ";
			}
			else
			{
				move_uploaded_file($_FILES["$f"]["tmp_name"],"upload/" . $newFileName);
				echo "Stored in: " . "upload/" . $newFileName;
			}
		}
	}
	else
	{
		echo "Invalid file";
	}
}
?>
<html>
<body>
<!-- Code by KhoiNguonIT.com -->
<form action="script.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" /> 
<input type="submit" name="submit" value="Upload" />
</form>
</body>
</html>  
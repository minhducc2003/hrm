<?php

	
	// PHPExcel
  	include('Classes/PHPExcel.php');
  	// connect database
  	require_once('Connections/Myconnection.php');

  	// export file excel
  	$objExcel = new PHPExcel;
  	$objExcel->setActiveSheetIndex(0);
  	$sheet = $objExcel->getActiveSheet()->setTitle('Bảng nhân viên');
  	// dinh dang file excel
  	// - dinh dang cho du kich thuoc noi dung
  	$sheet->getColumnDimension("A")->setAutoSize(true);
  	$sheet->getColumnDimension("B")->setAutoSize(true);
  	$sheet->getColumnDimension("C")->setAutoSize(true);
  	$sheet->getColumnDimension("D")->setAutoSize(true);
    $sheet->getColumnDimension("E")->setAutoSize(true);
    $sheet->getColumnDimension("F")->setAutoSize(true);
    $sheet->getColumnDimension("G")->setAutoSize(true);
    $sheet->getColumnDimension("H")->setAutoSize(true);
    $sheet->getColumnDimension("I")->setAutoSize(true);
    $sheet->getColumnDimension("J")->setAutoSize(true);
    $sheet->getColumnDimension("K")->setAutoSize(true);

  	// chinh mau dong title
  	$sheet->getStyle('A1:K1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
  	// canh giua
  	$sheet->getStyle('A1:K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  	// dem so dong
  	$rowCount = 1;
  	// set cho dong dau tien (dong tieu de)
  	$sheet->setCellValue('A' . $rowCount, 'STT');
  	$sheet->setCellValue('B' . $rowCount, 'Mã nhân viên');
  	$sheet->setCellValue('C' . $rowCount, 'Họ tên');
  	$sheet->setCellValue('D' . $rowCount, 'Giới tính');
    $sheet->setCellValue('E' . $rowCount, 'ĐTDD');
    $sheet->setCellValue('F' . $rowCount, 'Ngày sinh');
    $sheet->setCellValue('G' . $rowCount, 'Ngày vào làm');
    $sheet->setCellValue('H' . $rowCount, 'Công việc');
    $sheet->setCellValue('I' . $rowCount, 'Phòng ban');
    $sheet->setCellValue('J' . $rowCount, 'Mức lương');
    $sheet->setCellValue('K' . $rowCount, 'Tình trạng');
    

  	// do du lieu tu db
  	$sql = "SELECT nv.ma_nhan_vien as ma_nhan_vien, ho_ten, gioi_tinh, dt_di_dong, ngay_sinh, ngay_vao_lam, ten_cong_viec, ten_phong_ban, muc_luong_cb, nghi_viec FROM tlb_nhanvien nv, tlb_phongban pb, tlb_congviec cv, tlb_chucvu chvu, tlb_ctcongviec ctcv WHERE nv.ma_nhan_vien = cv.ma_nhan_vien AND cv.phong_ban_id = pb.phong_ban_id AND cv.cong_viec_id = ctcv.cong_viec_id AND cv.chuc_vu_id = chvu.chuc_vu_id && chvu.chuc_vu_id = 'NV002'";
  	$result = mysqli_query($Myconnection, $sql);
  	$stt = 0;
  	while ($row = mysqli_fetch_array($result)) 
  	{
  		// do du lieu tang len theo cac cot
  		$rowCount++;
  		$stt++;

      // cau hinh lai cac truong
      if($row['gioi_tinh'] == 1)
      {
        $gioiTinh = 'Nam';
      }
      else
      {
        $gioiTinh = 'Nữ';
      }

      if($row['nghi_viec'] == 1)
      {
        $nghiviec = 'Đã nghĩ việc';
      }
      else
      {
        $nghiviec = 'Còn làm việc';
      }

  		// do het du lieu ra cac dong
  		$sheet->setCellValue('A' . $rowCount, $stt);
	  	$sheet->setCellValue('B' . $rowCount, $row['ma_nhan_vien']);
	  	$sheet->setCellValue('C' . $rowCount, $row['ho_ten']);
	  	$sheet->setCellValue('D' . $rowCount, $gioiTinh);
      $sheet->setCellValue('E' . $rowCount, $row['dt_di_dong']);
      $sheet->setCellValue('F' . $rowCount, $row['ngay_sinh']);
      $sheet->setCellValue('G' . $rowCount, $row['ngay_vao_lam']);
      $sheet->setCellValue('H' . $rowCount, $row['ten_cong_viec']);
      $sheet->setCellValue('I' . $rowCount, $row['ten_phong_ban']);
      $sheet->setCellValue('J' . $rowCount, $row['muc_luong_cb']);
      $sheet->setCellValue('K' . $rowCount, $nghiviec);
  	}

  	// tao border
  	$styleArray = array(
  		'borders' => array(
  			'allborders' => array(
  				'style' => PHPExcel_Style_Border::BORDER_THIN
  			)
  		)
  	);
  	$sheet->getStyle('A1:' . 'K'.($rowCount))->applyFromArray($styleArray);

  	// tao tac xuat file
  	$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
  	$filename = 'nhan-vien-thoi-vu.xlsx';
  	$objWriter->save($filename);

  	// cau hinh khi xuat file
  	header('Content-Disposition: attachment; filename="' .$filename. '"'); // tra ve file kieu attachment
  	header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
  	header('Content-Legth: ' . filesize($filename));
  	header('Content-Transfer-Encoding: binary');
  	header('Cache-Control: must-revalidate');
  	header('Pragma: no-cache');
  	readfile($filename);
  	return;

?>
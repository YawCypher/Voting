<?php
session_start();
error_reporting(0);
include('includes/config.php');  
global $count;
 require_once 'PHPExcel.php';
 $objPHPExcel = new PHPExcel();
////////////////////////////////////////////////////////////////////////////////////////////////////
 $sql = "SELECT `Name`,indexNo,gender,PositionID,ballotNo,tblcandidate.votes,positionName FROM tblcandidate INNER JOIN tblposition ON PositionID = id ORDER BY PositionID ASC";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
 $objPHPExcel = new PHPExcel();
	$ews = $objPHPExcel->getSheet(0);
	$ews->setTitle('System Voters');
for ($col = ord('A'); $col <= ord('D'); $col++)
{
    $ews->getColumnDimension(chr($col))->setAutoSize(true);
}
	$header = 'A1:D1';
$ews->getStyle($header)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('00ffff00');
$style = array(
    'font' => array('bold' => true,),
    'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
    );
$ews->getStyle($header)->applyFromArray($style);
 $rowCount = 2;
	$objPHPExcel->getActiveSheet()->SetCellValue('A1','Name');
	$objPHPExcel->getActiveSheet()->SetCellValue('B1','Position');
$objPHPExcel->getActiveSheet()->SetCellValue('C1','votes');
 	foreach($results as $result){
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $result->Name);
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $result->positionName);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $result->votes);
	$rowCount++;
}

$filename = 'Voters';
 header('Content-Type: application/vnd.openxmlformats-   officedocument.spreadsheetml.sheet');
 header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
 header('Cache-Control: max-age=0');

 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
 ob_end_clean();
 $objWriter->save('php://output');
}
?>
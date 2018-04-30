<?php
	$name=$_POST["name"];
	$email=$_POST["emmail"];
	$Header = array('name','email');
	$data = array();
	array_push($data, array($name,$email));
	$filename = write_excel1($data, $Header);
	function write_excel1($data, $Header)
	{
		 require_once  './PHPExcel/Classes/PHPExcel.php';
		 $objPHPExcel = new PHPExcel();
		 $ActiveSheet = $objPHPExcel->setActiveSheetIndex(0);
		 $i=0;
    foreach($Header as $ind_el)
    {
        
        $Location = PHPExcel_Cell::stringFromColumnIndex($i) . '1';
        $ActiveSheet->setCellValue($Location, $ind_el);
        $i++;
    }

    $rowIndex=2;
    $columnIndex=0;
    foreach($data as $row)
    {           
        foreach($row as $ind_el)
        {       

            $Location = PHPExcel_Cell::stringFromColumnIndex($columnIndex) . $rowIndex;
         
            $ActiveSheet->setCellValue($Location, $ind_el);
            $columnIndex++;
        }

        $rowIndex++;

    }       

    $Range = 'A1:B1';
    $color = 'FFFF0000';
    $ActiveSheet->getStyle($Range)->getFill($Range)->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB($color);


    for($i=0; $i<count($Header);$i++)
    {
        $Location = PHPExcel_Cell::stringFromColumnIndex($i) ;
        $ActiveSheet->getColumnDimension($Location)->setAutoSize(true); 
    }


    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

    $objPHPExcel = PHPExcel_IOFactory::load("myfile.xlsx");

    $objWriter->save('myfile.xlsx');

}

?>

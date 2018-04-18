<?php


    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$writer->save('robots.xlsx');

//
//﻿$objPHPExcel = new Spreadsheet();
//
//    // Set document properties
//$objPHPExcel->getProperties()->setCreator("PKW")
//->setLastModifiedBy("PKW")
//->setTitle("Export")
//->setSubject("Export document");
//
//
//
//$objPHPExcel->getSheet(0)->setTitle('list');
//
//$objPHPExcel->getActiveSheet()->setCellValue("B1", 'Тариф за дневные часы');
//$objPHPExcel->getActiveSheet()->setCellValue("F1", $input['dayPrice']);
//
//$objPHPExcel->getActiveSheet()->setCellValue("B2", 'Тариф за вечерние часы');
//$objPHPExcel->getActiveSheet()->setCellValue("F2", $input['eveningPrice']);
//
//$objPHPExcel->getActiveSheet()->setCellValue("B3", 'Тариф STARK');
//$objPHPExcel->getActiveSheet()->setCellValue("F3", $input['coefStark']);
//
//$objPHPExcel->getActiveSheet()->setCellValue("H2", 'Тариф за бонусы');
//$objPHPExcel->getActiveSheet()->setCellValue("L2", $input['bonusPrice']);
//
//$objPHPExcel->getActiveSheet()->setCellValue("H3", 'Курс валюты');
//$objPHPExcel->getActiveSheet()->setCellValue("L3", $input['currencyCoef']);
//
//$objPHPExcel->getActiveSheet()->setCellValue("H4", 'Тариф за переработку');
//$objPHPExcel->getActiveSheet()->setCellValue("L4", $input['moreOrder']);
//
//$objPHPExcel->getActiveSheet()->setCellValue("A5", 'ФИО');
//$objPHPExcel->getActiveSheet()->setCellValue("B5", 'Ставка по ЗП');
//$objPHPExcel->getActiveSheet()->setCellValue("C5", 'Дневные часы');
//$objPHPExcel->getActiveSheet()->setCellValue("D5", 'Деньни за дневные часы');
//$objPHPExcel->getActiveSheet()->setCellValue("E5", 'Вечерние часы');
//$objPHPExcel->getActiveSheet()->setCellValue("F5", 'Деньни за вечерние часы');
//$objPHPExcel->getActiveSheet()->setCellValue("G5", 'Все купоны');
//$objPHPExcel->getActiveSheet()->setCellValue("H5", 'Линки');
//
//$objPHPExcel->getActiveSheet()->setCellValue("I5", 'Норма переработки');
//$objPHPExcel->getActiveSheet()->setCellValue("J5", 'Переработка');
//$objPHPExcel->getActiveSheet()->setCellValue("K5", 'Сумма за переработку');
//
//$objPHPExcel->getActiveSheet()->setCellValue("L5", 'Норма STARK');
//$objPHPExcel->getActiveSheet()->setCellValue("M5", 'Переработка STARK');
//$objPHPExcel->getActiveSheet()->setCellValue("N5", 'Сумма за переработку STARK');
//
//$objPHPExcel->getActiveSheet()->setCellValue("O5", 'Бонусы');
//$objPHPExcel->getActiveSheet()->setCellValue("P5", 'Деньги за бонусы');
//$objPHPExcel->getActiveSheet()->setCellValue("Q5", 'Всего');
//$objPHPExcel->getActiveSheet()->setCellValue("R5", 'Всего в валюте');
//
//$i = 6;
//foreach ($data as $row) {
//$objPHPExcel->getActiveSheet()->setCellValue("A{$i}", $row['name']);
//                $objPHPExcel->getActiveSheet()->setCellValue("C{$i}", $row['dayHours']);
//                $objPHPExcel->getActiveSheet()->setCellValue("D{$i}", "=C{$i}*F1");
//                $objPHPExcel->getActiveSheet()->setCellValue("E{$i}", $row['eveningHours']);
//                $objPHPExcel->getActiveSheet()->setCellValue("F{$i}", "=E{$i}*F2");
//                $objPHPExcel->getActiveSheet()->setCellValue("G{$i}", $row['coupons']);
//                $objPHPExcel->getActiveSheet()->setCellValue("H{$i}", $row['otherBonus']);
//
//                $objPHPExcel->getActiveSheet()->setCellValue("I{$i}", '');
//                $objPHPExcel->getActiveSheet()->setCellValue("J{$i}", '=IF(I'.$i.'<>"",G'.$i.'+H'.$i.'-I'.$i.',"")');
//                $objPHPExcel->getActiveSheet()->setCellValue("K{$i}", '=IF(J'.$i.'<>"",IF(J'.$i.'>0,J'.$i.'*L4,0),0)');
//
//                $objPHPExcel->getActiveSheet()->setCellValue("L{$i}", '');
//                $objPHPExcel->getActiveSheet()->setCellValue("M{$i}", $row['starkBonus']);
//                $objPHPExcel->getActiveSheet()->setCellValue("N{$i}", '=IF(L'.$i.'<>"",IF(M'.$i.'<>"",IF(M'.$i.'>0,(M'.$i.'-L'.$i.')*F3,0),0),0)');
//
//                $objPHPExcel->getActiveSheet()->setCellValue("O{$i}", '');
//                $objPHPExcel->getActiveSheet()->setCellValue("P{$i}", "=O{$i}*L2");
//
//                $objPHPExcel->getActiveSheet()->setCellValue("Q{$i}", "=B{$i}+D{$i}+F{$i}+K{$i}+N{$i}+P{$i}");
//                $objPHPExcel->getActiveSheet()->setCellValue("R{$i}", "=ROUND(Q{$i}/L3, 2)");
//
//                $i++;
//
//            }
//
//            static::setFileStyle($objPHPExcel);
//
//            $filename = 'Расчет зарплат OD - ' . rand(1, 99999);
//            header('Content-Type: application/vnd.ms-excel');
//            header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
//            header('Cache-Control: max-age=0');
//
//            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//
//            $objWriter->save('php://output');
//
//            $sendMail and self::sendExportMail($data, $input);
//
//            exit();

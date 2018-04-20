<?php
namespace App\Table;

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    class Table
    {
        protected $result;
        public $fileName;

        public function __construct($result)
        {
            $this->result = $result;
        }

        public function createTable()
        {
            $table = new Spreadsheet();
            $page = $table->getActiveSheet();
            $page->setCellValue('A1', '№');
            $page->setCellValue('B1', 'Название проверки');
            $page->setCellValue('C1', 'Статус');
            $page->setCellValue('E1', 'Текущее состояние');

            $i = 3;
            foreach ($this->result as $key => $row) {
                $page->setCellValue("A{$i}", $key);
                $page->setCellValue("B{$i}", $row['test']);
                $page->setCellValue("C{$i}", $row['status']);
                if ($row['status'] === 'Оk'){
                    $page->getStyle("C{$i}")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('FFFF0000');
                } else {
                    $page->getStyle("C{$i}")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('FF00FF00');;
                }
                $page->setCellValue("D{$i}", 'Состояние');
                $page->setCellValue("E{$i}", $row['state']);
                $i++;
                $page->setCellValue("D{$i}", 'Рекомендации');
                $page->setCellValue("E{$i}", $row['recommendation']);
                $i++;
            }

            $this->fileName = 'robotsTest'.rand(1,1212).'.xlsx';

            $writer = new Xlsx($table);
            $writer->save($this->fileName);
        }

    }


<?php

/*
 * Project Name: onelab.gov.ph * 
 * Copyright(C)2018 Department of Science & Technology -IX * 
 * Developer: Eng'r Nolan F. Sunico  * 
 * 03 7, 18 , 1:54:45 PM * 
 * Module: Yii2Excel * 
 */

namespace app\components;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PHPExcel_Style_Fill;
use PHPExcel_Style_NumberFormat;

/**
 * Description of Yii2Excel
 * @author OneLab
 */
class Yii2Excel{
    /* @var $SpreadSheet Spreadsheet */
    /* @var $Sheet */
    static $path="download/";
    static $pFilename;
    static $SpreadSheet;
    static $Sheet;
    static $TotalColumn=0;
    static $LastLetter="";
    /**
     * 
     * @param type $ExcelFilename
     */
    public function __construct($TotalColumn,$ExcelFilename="Income.xlsx"){ 
        try{
           self::$TotalColumn=$TotalColumn+2;
           self::$pFilename=self::$path.$ExcelFilename;
           self::$SpreadSheet = new SpreadSheet();
           self::$Sheet = self::$SpreadSheet->getActiveSheet();
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    /**
     * 
     * @param type $MainHeader
     * @param type $SubHeader
     */
    public function CreateHeader($MainHeader, $SubHeader){
        //Main Header
        self::$LastLetter= $this->columnLetter(self::$TotalColumn);
        self::$Sheet->setCellValue('A1', $MainHeader);
        self::$Sheet->mergeCells("A1:".self::$LastLetter."1");
        self::$Sheet->getStyleByColumnAndRow(1, 1)->getFont()->setBold(true);
        self::$Sheet->getStyleByColumnAndRow(1, 1)->getFont()->setSize(15);
        self::$Sheet->getCellByColumnAndRow(1, 1)->getStyle()->getAlignment()->setHorizontal("center");
        //Sub Header
        self::$Sheet->setCellValue('A2', $SubHeader);
        self::$Sheet->mergeCells("A2:".self::$LastLetter."2");
        self::$Sheet->getStyleByColumnAndRow(1, 2)->getFont()->setBold(true);
        self::$Sheet->getStyleByColumnAndRow(1, 2)->getFont()->setSize(10);
        self::$Sheet->getCellByColumnAndRow(1, 2)->getStyle()->getAlignment()->setHorizontal("center");
    }
    public function GenerateDetails($ProcerdureName,$Params, $Connection){
        $Rows=\Yii::$app->Functions->ExecuteStoredProcedureRows($ProcerdureName,$Params , $Connection);
        $i=3;
        $init=true;
        $StartYear=(int)$Params['mStartYear'];
        $EndYear=(int)$Params['mEndYear'];
        foreach($Rows as $Row){
            if($init){
                $init=false;
                $col=1;
                self::$Sheet->setCellValue($this->columnLetter($col).$i, "REGION");
                self::$Sheet->getStyleByColumnAndRow($col, $i)->getFont()->setBold(true);
                self::$Sheet->getColumnDimension($this->columnLetter($col))->setWidth(10);
                self::$Sheet->getCellByColumnAndRow($col, $i)->getStyle()->getAlignment()->setHorizontal("center");
                $this->SetBackgroundColor("A3:".$this->columnLetter($col)."3");
                $col=$col+1;
                for($counter=$StartYear;$counter<=$EndYear;$counter++){
                    //Generate the RowHeader
                    self::$Sheet->setCellValue($this->columnLetter($col).$i, $counter);
                    self::$Sheet->getStyleByColumnAndRow($col, $i)->getFont()->setBold(true);
                    self::$Sheet->getColumnDimension($this->columnLetter($col))->setWidth(15);
                    self::$Sheet->getCellByColumnAndRow($col, $i)->getStyle()->getAlignment()->setHorizontal("right");
                    $col++;
                }
                self::$Sheet->setCellValue($this->columnLetter($col).$i, "TOTAL");
                self::$Sheet->getStyleByColumnAndRow($col, $i)->getFont()->setBold(true);
                self::$Sheet->getColumnDimension($this->columnLetter($col))->setWidth(15);
                self::$Sheet->getCellByColumnAndRow($col, $i)->getStyle()->getAlignment()->setHorizontal("right");
                $this->SetBackgroundColor("A3:".$this->columnLetter($col)."3");
                $i++;
            }else{
                
            }
            $SeriesObj=(object)$Row;
            self::$Sheet->setCellValue("A".$i, $SeriesObj->Region);
            self::$Sheet->getStyle("B".$i.":".$this->columnLetter($col).$i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $col=2;
            for($counter=$StartYear;$counter<=$EndYear;$counter++){
                self::$Sheet->setCellValue($this->columnLetter($col).$i, $Row[$counter]);
                $col++;
            }
            self::$Sheet->setCellValue($this->columnLetter($col).$i, "=sum(B".$i.":".$this->columnLetter($col-1).$i.")");
            $i++;
        }
        $col=2;
        self::$Sheet->setCellValue("A".$i, "TOTAL");
        for($counter=$StartYear;$counter<=$EndYear;$counter++){
            //Generate the RowFooter
            self::$Sheet->setCellValue($this->columnLetter($col).$i, "=sum(".$this->columnLetter($col)."4:".$this->columnLetter($col).($i-1).")");
            self::$Sheet->getStyleByColumnAndRow($col, $i)->getFont()->setBold(true);
            self::$Sheet->getColumnDimension($this->columnLetter($col))->setWidth(15);
            self::$Sheet->getCellByColumnAndRow($col, $i)->getStyle()->getAlignment()->setHorizontal("right");
            $col++;
        }
         self::$Sheet->setCellValue($this->columnLetter($col).$i, "=sum(".$this->columnLetter($col)."4:".$this->columnLetter($col).($i-1).")");
         self::$Sheet->getStyle("B".$i.":".$this->columnLetter($col).$i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
         $this->SetBackgroundColor("A".$i.":".$this->columnLetter($col).$i);
    }
    public function SetBackgroundColor($Range,$BackColor="448cf8",$FontColor="FFFFFF"){
        $styleArray = [
            'font'  => [
                'bold'  => true,
                'color' => ['rgb' => $FontColor], //FF0000
                'size'  => 10,
                'name'  => 'Verdana'
            ]
        ];
        self::$Sheet->getStyle($Range)->applyFromArray($styleArray);
        self::$Sheet->getStyle($Range)
                ->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB($BackColor);//FFE8E5E5
    }
    public function ExportToExcel(){
        try{
        $writer = new Xlsx(self::$SpreadSheet);
        $writer->save(self::$pFilename);
        return self::$pFilename;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    public function columnLetter($c){
    $c = intval($c);
    if ($c <= 0) return '';
        $letter = '';        
        while($c != 0){
            $p = ($c - 1) % 26;
            $c = intval(($c - $p) / 26);
            $letter = chr(65 + $p) . $letter;
    }
    return $letter;
        
    }
}

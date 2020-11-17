<?php
require ('fpdf.php');

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm 

$pdf = new FPDF('p','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell( width , height , text , border , end line , [align] )
$pdf->Cell(130 ,5,'RubberDuckShop',1,0); 
$pdf->Cell(59 ,5,'Invoice',1,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('arial','',12);

$pdf->Cell(130 ,5,'[Date]',1,0); 
$pdf->Cell(59 ,5,'',1,1);//end of line

$pdf->Cell(130 ,5,'[Details]',1,0); 
$pdf->Cell(59 ,5,'',1,1);//end of line


$pdf->Output();
?>
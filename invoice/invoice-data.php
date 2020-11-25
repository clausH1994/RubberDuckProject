<?php
require ('fpdf.php');
require ('../connection/dbcon.php');
$dbCon = dbCon();


$sql = "SELECT o.orderID, o.date, ol.product, p.name, p.price, o.invoice, o.numberOfProducts, c.customerID, c.fname, c.lname, c.phonenumber, c.address, c.postalID
FROM `Order` o, Orderline ol, Product p, Customer c
WHERE o.orderID = ol.order
AND ol.product = p.ID
AND o.invoice = :invoiceID";

$handle = $dbCon->prepare($sql);
$handle->bindParam(':invoiceID', $_GET['invoiceID']); //$_GET['invoiceID'];
$handle->execute();

//$handle->fetch();

//$invoice = $handle->fetchAll();
//var_dump($invoice);

$invoiceID;

while ($row = $handle->fetch()) {
    $invoiceID = $row["invoice"];
    $date = $row["date"];
    $customer = $row["customerID"];
    $orderID = $row["orderID"];
    $row["product"] . ", " . $row["name"] . "<br>";
    $cName = [];  
}


//var_dump($sql);
//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm 

$pdf = new FPDF('p','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell( width , height , text , border , end line , [align] )
$pdf->Cell(130 ,5,'RubberDuckShop',0,0); 
$pdf->Cell(59 ,5,'Invoice',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('arial','',12);

$pdf->Cell(130 ,5,'[Street Address]',0,0); 
$pdf->Cell(59 ,5,'',0,1);//end of line

$pdf->Cell(130 ,5,'[City, Country, ZIP]',0,0); 
$pdf->Cell(25 ,5,'Date',0,0);
$pdf->Cell(34 ,5,$date,0,1);//end of line

$pdf->Cell(130 ,5,'Phone [+45 12345678]',0,0); 
$pdf->Cell(25 ,5,'Invoice #',0,0);
$pdf->Cell(34 ,5,$invoiceID,0,1);//end of line

$pdf->Cell(130 ,5,'Email [Dummy@email.com]',0,0); 
$pdf->Cell(25 ,5,'Customer ID',0,0);
$pdf->Cell(34 ,5,$customer,0,1);//end of line

//make a dummy empty cell as vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//billing address
$pdf->Cell(100 ,10,'Bill to',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,'[Name]',0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,'[Company Name]',0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,'[Address]',0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,'[Phone]',0,1);

//make a dummy empty cell as vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(155 ,5,'Description',1,0);
$pdf->Cell(34 ,5,'Amount',1,1);//end of line

$pdf->SetFont('Arial','',12);

//numbers are right aligned so we give 'R' after new line parameter
$price = 0;
$handle->execute(); 
while ($item = $handle->fetch()) {

$pdf->Cell(155 ,5,$item['name'],1,0);
$pdf->Cell(34 ,5,$item['price'],1,1,'R');//end of line    

$price += $item['price'];

}

//summary

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Total Due',0,0);
$pdf->Cell(5 ,5,'kr',1,0);
$pdf->Cell(29 ,5,number_format($price),1,1,'R');//end of line


$pdf->Output();
?>
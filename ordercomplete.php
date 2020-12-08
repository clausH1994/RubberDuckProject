<?php
require_once ("connection/Redirector.php");
require ('invoice/fpdf.php');
require ('connection/dbcon.php');
require_once ("connection/session.php");

$session = new Session();

$dbCon = dbCon();


$sql = "SELECT * FROM InvoiceOrderData
WHERE invoice = :invoiceID";

$handle = $dbCon->prepare($sql);
$handle->bindParam(':invoiceID', $_SESSION['invoice']); //$_GET['invoiceID'];
$handle->execute();

$query = "SELECT co.name, co.address, co.postalID, co.phone, co.email, pc.zipcodeID, pc.City 
FROM Company co, PostalCode pc
WHERE co.postalID = pc.zipcodeID";
//$handle->fetch();
$cData = $dbCon->prepare($query);
$cData->execute();
//$invoice = $handle->fetchAll();
//var_dump($invoice);
$getCompany = $cData->fetchAll();

$invoiceID;

while ($row = $handle->fetch()) {
    $invoiceID = $row["invoice"];
    $date = $row["date"];
    $customer = $row["customerID"];
    $orderID = $row["orderID"];
    $row["product"] . ", " . $row["name"] . "<br>";
    $cName = $row["fname"] . " " . $row["lname"];
    $address = $row["address"];
    $city = $row["zipcodeID"] . " " . $row["City"];
    $phone = $row["phonenumber"];
    $cemail = $row['email'];  
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
$pdf->Cell(130 ,5,$getCompany[0]["name"],0,0); 
$pdf->Cell(59 ,5,'Invoice',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('arial','',12);

$pdf->Cell(130 ,5,$getCompany[0]["address"],0,0); 
$pdf->Cell(59 ,5,'',0,1);//end of line

$pdf->Cell(130 ,5,$getCompany[0]["postalID"]. " " .$getCompany[0]["City"],0,0); 
$pdf->Cell(25 ,5,'Date',0,0);
$pdf->Cell(34 ,5,$date,0,1);//end of line

$pdf->Cell(130 ,5,$getCompany[0]["phone"],0,0); 
$pdf->Cell(25 ,5,'Invoice #',0,0);
$pdf->Cell(34 ,5,$invoiceID,0,1);//end of line

$pdf->Cell(130 ,5,$getCompany[0]["email"],0,0); 
$pdf->Cell(25 ,5,'Customer ID',0,0);
$pdf->Cell(34 ,5,$customer,0,1);//end of line

//make a dummy empty cell as vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//billing address
$pdf->Cell(100 ,10,'Bill to',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$cName,0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$address,0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$city,0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$phone,0,1);

//make a dummy empty cell as vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(121 ,5,'Description',1,0);
$pdf->Cell(34 ,5,'Quantity',1,0);
$pdf->Cell(34 ,5,'Amount',1,1);//end of line

$pdf->SetFont('Arial','',12);

//numbers are right aligned so we give 'R' after new line parameter
$price = 0;
$totalPrice = 0;
$handle->execute(); 
while ($item = $handle->fetch()) {
$price = $item['price'] * $item['quantity'];
$pdf->Cell(121 ,5,$item['name'],1,0);
$pdf->Cell(34 ,5,$item['quantity'],1,0);
$pdf->Cell(34 ,5,$price,1,1,'R');//end of line    

$totalPrice += $price;

}

//summary

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Total Due',0,0);
$pdf->Cell(5 ,5,'kr',1,0);
$pdf->Cell(29 ,5,number_format($totalPrice),1,1,'R');//end of line

$strint = strval($_SESSION['invoice']);

$print = "invoices/" . $strint . ".pdf";

$pdf->Output($print,"f");




$cusmail = $cemail;
$name = $cName;
$email = $getCompany[0]["email"];

$RegXp = "";


// Recipient 
$to = $cusmail; 
 
// Sender 
$from = $email; 
$fromName = 'Rubber Duck Shop'; 
 
// Email subject 
$subject = 'Din Ordre er komplet';  
 
// Attachment file 
$file = $print; 
 
// Email body content 
$htmlContent = ' 
    <h3>Din ordre er modtaget</h3> 
    <p>Vi har modtaget din ordre og er i gange med at bearbejde den.</p> </br>
    <p>Vi forventer der går et par uger før vi sender den</p> 
'; 
 
// Header for sender info 
$headers = "From: $fromName"." <".$from.">"; 
 
// Boundary  
$semi_rand = md5(time());  
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
 
// Headers for attachment  
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
 
// Multipart boundary  
$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  
 
// Preparing attachment 
if(!empty($file) > 0){ 
    if(is_file($file)){ 
        $message .= "--{$mime_boundary}\n"; 
        $fp =    @fopen($file,"rb"); 
        $data =  @fread($fp,filesize($file)); 
 
        @fclose($fp); 
        $data = chunk_split(base64_encode($data)); 
        $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .  
        "Content-Description: ".basename($file)."\n" . 
        "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .  
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
    } 
} 
$message .= "--{$mime_boundary}--"; 
$returnpath = "-f" . $from; 
 
// Send email 
$mail = @mail($to, $subject, $message, $headers, $returnpath);  
 
// Email sending status 
if ($mail=true){
    $redirect = new Redirector("thankyou.php");
}

else {
    $redirect = new Redirector("index.php");
}

?>
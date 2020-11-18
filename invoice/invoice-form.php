<?php
require ('../connection/dbcon.php');

$dbCon = dbCon();
?>

<html>
    <head>
    <title>Invoice Handeler</title>
    </head>
         <body> 
            select Invoice   
        <form method="get" action="invoice.php">
            <select name="invoiceID">
            <?php
            $query = $dbCon->prepare("SELECT * FROM Invoice");
            $query->execute();
            $getData = $query->fetchAll();
            foreach($getData as $getData){
                echo "<option value='".$getData['invoiceID']."'>".$getData['invoiceID']."</option>";
            }
            
            ?>
            </select>
            <input type="submit" value="Generate">
        </form>
        </body>
</html>


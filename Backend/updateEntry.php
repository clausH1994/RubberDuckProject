<?php
require_once "../connection/dbcon.php";

if (isset($_POST['submit'])) 
{
    $entryID = $_POST['entryID'];
    $Code = $_POST['Code'];
    $Name = $_POST['Name'];
    $Color = $_POST['Color'];
    $Price = $_POST['Price'];
    $Image = $_POST['Image'];
    $Quantity = $_POST['Quantity'];
    $description = $_POST['description'];




try {  
    // $query = $dbCon->prepare("UPDATE product SET `name`='$Name', `color`='$Color', `price`='$Price', `image`='$Image', `description`='$description' WHERE productID=$entryID");
    // $query->execute();

    
    $sql = "UPDATE Product SET `code`=:code, `name`=:name, `color`=:color, `price`=:price, `image`=:image, `quantity`=:quantity, `desc`=:description WHERE ID=:ID";
    //$sql = "UPDATE product SET `name`=:name WHERE productID=:ID";
    $query = dbCon()->prepare($sql);

    $sanitized_id = htmlspecialchars(trim($entryID));
    $sanitized_code = htmlspecialchars(trim($Code));
    $sanitized_name = htmlspecialchars(trim($Name));
    $sanitized_color = htmlspecialchars(trim($Color));
    $sanitized_price = htmlspecialchars(trim($Price));
    $sanitized_image = htmlspecialchars(trim($Image));
    $sanitized_quantity = htmlspecialchars(trim($Quantity));
    $sanitized_desc = htmlspecialchars(trim($description));
    $query->bindParam(':code', $sanitized_code);
    $query->bindParam(':name', $sanitized_name);
    $query->bindParam(':color', $sanitized_color);
    $query->bindParam(':price', $sanitized_price);
    $query->bindParam(':image', $sanitized_image);
    $query->bindParam(':quantity', $sanitized_quantity);
    $query->bindParam(':description', $sanitized_desc);

    $query->execute();
    
    header("Location: index.php?status=updated&ID=$ID");

// }else{
//    header("Location: index.php?status=0");
//}

}

catch(\Throwable $ex){
    echo "Error:" . $ex->getMessage();
  }

}
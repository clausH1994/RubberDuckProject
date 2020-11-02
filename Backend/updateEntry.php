<?php
require_once "../connection/dbcon.php";

if (isset($_POST['submit'])) 
{
    $entryID = $_POST['entryID'];
    $Name = $_POST['Name'];
    $Color = $_POST['Color'];
    $Price = $_POST['Price'];
    $Image = $_POST['Image'];
    $description = $_POST['description'];


    echo "INside if.....";


try {  
    // $query = $dbCon->prepare("UPDATE product SET `name`='$Name', `color`='$Color', `price`='$Price', `image`='$Image', `description`='$description' WHERE productID=$entryID");
    // $query->execute();

    
    $sql = "UPDATE product SET `name`=:name, `color`=:color, `price`=:price, `image`=:image, `description`=:description WHERE productID=:ID";
    //$sql = "UPDATE product SET `name`=:name WHERE productID=:ID";
    $query = dbCon()->prepare($sql);

    $sanitized_id = htmlspecialchars(trim($entryID));
    $sanitized_name = htmlspecialchars(trim($Name));
    $sanitized_color = htmlspecialchars(trim($Color));
    $sanitized_price = htmlspecialchars(trim($Price));
    $sanitized_image = htmlspecialchars(trim($Image));
    $sanitized_desc = htmlspecialchars(trim($description));
    $query->bindParam(':ID', $sanitized_id);
    $query->bindParam(':name', $sanitized_name);
    $query->bindParam(':color', $sanitized_color);
    $query->bindParam(':price', $sanitized_price);
    $query->bindParam(':image', $sanitized_image);
    $query->bindParam(':description', $sanitized_desc);
    

    var_dump($query);
    var_dump($sanitized_name);
    // var_dump($sanitized_color);
    // var_dump($sanitized_price);
    // var_dump($sanitized_image);
    // var_dump($sanitized_desc);
    var_dump($sanitized_id);

    $query->execute();
    
    header("Location: index.php?status=updated&ID=$ProductID");

// }else{
//     header("Location: index.php?status=0");
//}

}

catch(\Throwable $ex){
    echo "Error:" . $ex->getMessage();
  }

}
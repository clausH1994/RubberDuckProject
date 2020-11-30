<?php require_once "../connection/dbcon.php";
require "../header.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<?php
$dbCon = dbCon();
$query = $dbCon->prepare("SELECT * FROM Company");
$query->execute();
$getData = $query->fetchAll();

?>
<body>

<div class="container">

    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "message sent") {
            echo "your email has been sent successfully";
            echo "<script>M.toast({html: 'mail sent'})</script>";
        }  elseif ($_GET['status'] == "please try again") {
            echo "something went wrong";
            echo "<script>M.toast({html: 'try again'})</script>";
        }
    }
    ?>
    <div class="row">
        <h2>Customer support</h2>
        <br>
        <h4>Opening hours</h4>
        
        <tr >
                    <th>Monday-Friday: 08:00-21:00</th>
                    <br>
                    <th>Saturday: 10:00-16:00</th>
                    <br>
                    <th>Sunday: 10:00-13:00</th>
                </tr>
        <hr>
        <h3>Contact form</h3>
        <br>
        <form action="contactData.php" method="post">
        Name: <input type="text" name="name" size="30">
        Email: <input type="text" name="email" size="30">
        Subject: <input type="text" name="subject" size="30">
        Message:<textarea name="message" cols="30" rows="30"></textarea>
        <input type="submit" id="submit" name="submit" value="Send">
</form> 


    </div>
</div>
</body>
</html>
<?php require_once "../connection/dbcon.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <title>about us</title>
</head>
<?php
$dbCon = dbCon();
$query = $dbCon->prepare("SELECT * FROM company");
$query->execute();
$getData = $query->fetchAll();
?>

<body>

<?php
foreach ($getData as $getData) {
$getData['name']; 
$getData['address'];
$getData['postalID'];
$getData['phone'];
$getData['email'];
$getData['description'];
}
?>


    <div class="container">
    <h2> <?php echo $getData['name'] ;?> </h2>
    <br>
        <div class="row">
   <div class="col s12" name="about" action="aboutUs.php">

    <div class=""></div>
        <div class="container col s6">
            <br>
          <h3>About us</h3>
          <p> <?php echo $getData['description'] ;?> </p>  
        </div>
        <br>
        <div class="container col s6">
          <h3>Contact info</h3>
          <br>
          <h4>Email</h4>
          <p> <?php echo $getData['email'] ;?> </p>
          <br>
          <h4>Phone</h4>
          <p> <?php echo $getData['phone'] ;?> </p>  
            <br>
          <h3>Address</h3>
                <p> <?php echo $getData['address'] ;?> </p>
                <p> <?php echo $getData['postalID'] ;?> </p>
        </div>
    </div>
               

</div>         
    

</body>
</html>
<?php require_once "../connection/dbcon.php"; ?>
<?php// require_once "aboutUsData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <title> about us</title>
</head>
<?php
$dbCon = dbCon();
$query = $dbCon->prepare("SELECT * FROM company");
$query->execute();
$getData = $query->fetchAll();
?>

<body>
    <h3> <?php// echo $getData['name'];?> </h3>
<div class="col s10" name="about" action="aboutUs.php">
    <div class="row">
        <div class="container">
<?php
foreach ($getData as $getData) {
echo $getData['name']; 
echo "<br><br>";
echo $getData['address'];
echo "<br><br>";
echo $getData['postalID'];
echo "<br><br>";
echo $getData['phone'];
echo "<br><br>";
echo $getData['email'];
echo "<br><br>";
echo $getData['description'];
}
?>
            
        </div>
    </div>
</div>
</body>
</html>
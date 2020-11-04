<?php require_once "../connection/dbcon.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <title>About</title>
</head>
<?php
$dbCon = dbCon();
$query = $dbCon->prepare("SELECT * FROM company");
$query->execute();
$getData = $query->fetchAll();
?>

<body>
    <div class="container">
<?php
foreach ($getData as $getData) {
echo $getData['name'];
echo " ";
echo $getData['address'];
echo " ";
echo $getData['postalID'];
echo " ";
echo $getData['phone'];
echo " ";
echo $getData['email'];
echo " ";
echo $getData['description'];
}
?>
</div>
</body>
</html>
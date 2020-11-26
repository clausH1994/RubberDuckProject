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
        <h3>Customer support</h3>

        <form class="col s12" name="contact" method="post" action="">
            <div class="row">
                <div class="input-field col s12">
                    <input id="name" name="name" type="text" class="validate" required="" aria-required="true">
                    <label for="name">Name</label>
                </div>
            </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="phone" name="phone" type="text" class="validate" required="" aria-required="true">
                    <label for="phone">Phone</label>
                </div>
                <div class="row">
                <div class="input-field col s12">
                    <input id="email" name="email" type="text" class="validate" required="" aria-required="true">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea name="description" id="description" class="materialize-textarea" required="" aria-required="true"></textarea>
                    <label for="description">Message</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="submit">Submit
            </button>
        </form>
    </div>
</div>
</body>
</html>
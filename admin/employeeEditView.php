<?php


spl_autoload_register(function ($class) {
    include "../connection/" . $class . ".php";
});
if (!isset($_GET['ID'])) {
    $redirector = new Redirector("employeeView.php");
}

?>

<?php require_once("employeeController.php");



$employeeCon = new employeeController();
$employee = $employeeCon->readEmployeeById($_GET['ID']);


?>



<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>
<div class="container">
    <div>
        <h2>Edit Employee</h2>
        <form action="" method="post">
            First Name:
            <input type="text" name="fname" value="<?php echo $employee[0][1]; ?>">
            Last Name:
            <input type="text" name="lname" value="<?php echo $employee[0][2]; ?>">
            Email:
            <input type="text" name="email" maxlength="30" value="<?php echo $employee[0][3]; ?>" />
            <button class="btn waves-effect waves-light" type="submit" name="submit">Update Employee</button>
            <button class="btn" style="background-color: red; color:white;" type="submit" name="cancel" value="Cancel">Cancel</button>
        </form>
    </div>
</div>

<?php


if (isset($_POST['submit'])) { // Form has been submitted.
    $employeeCon->editEmployee($_GET['ID'], $_POST["fname"],  $_POST["lname"], $_POST["email"], $employee[0][4]);
}

if (isset($_POST['cancel'])) { // Form has been submitted.
    $redirector = new Redirector("employeeView.php");
}

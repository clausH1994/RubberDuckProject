<?php
require("adminHeader.php");

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

<div class="container">
    <div>
        <h2>Edit Employee</h2>
        <?php

        // START FORM PROCESSING
        if (isset($_POST['submit'])) { // Form has been submitted.
            $regexp = "/^[^0-9][A-z0-9_-]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_-]+)*[.][A-z]{2,4}$/";
            if (!preg_match($regexp, $_POST['email'])) {
        ?> <p style="color: red; font-size: 20px;">please enter a valid mail</p>
        <?php
            } else {
                $employeeCon->editEmployee($_GET['ID'], $_POST["fname"],  $_POST["lname"], $_POST["email"], $employee[0][4]);
            }
        }


        ?>

        <form action="" method="post">
            First Name:
            <input type="text" name="fname" value="<?php echo $employee[0][1]; ?>" required />
            Last Name:
            <input type="text" name="lname" value="<?php echo $employee[0][2]; ?>" required />
            Email:
            <input type="text" name="email" maxlength="30" value="<?php echo $employee[0][3]; ?>" required />
            <button class="btn waves-effect waves-light" type="submit" name="submit">Update Employee</button>
            <a href="employeeView.php" class="waves-effect waves-light btn red">Cancel</a>
        </form>
    </div>
</div>

<?php

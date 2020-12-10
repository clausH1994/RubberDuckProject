<?php
require_once("../connection/session.php");
require_once("CustomerController.php");
require_once("../header.php");


if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];

$cusCon = new CustomerController();


$session->confirm_userlogged_in();


$loggedInUser = $_SESSION['user_id'];

$customer = $cusCon->readCustomerById($loggedInUser);


if (isset($_POST['submit'])) { // Form has been submitted.
    if (!empty($_POST['token'])) {
        if (hash_equals($_SESSION['token'], $_POST['token'])) {
            unset($_SESSION['token']);
            $cusCon->updateCustomer($_POST["fname"], $_POST["lname"], $_POST["pass"], $_POST["phone"], $_POST["email"], $_POST["address"], $_POST["zipcode"], $loggedInUser, $_POST["city"]);
        } else {
            die('CSRF VALIDATION FAILED');
        }
    } else {
        die('CSRF TOKEN NOT FOUND. ABORT');
    }
}

?>

<body>
    <div class="container">
        <div class="container">

            <div>
                <h2>Update Customer Account</h2>

                <form class="col s12" method="post">
                    <div class="row">
                        <div class="input-field col s6">
                            First Name:
                            <input type="text" name="fname" value="<?php echo $customer[0][1]; ?>">
                        </div>

                        <div class="input-field col s6">
                            Last Name:
                            <input type="text" name="lname" value="<?php echo $customer[0][2]; ?>">
                        </div>

                        <div class="input-field col s6">
                            Phone Number:
                            <input type="text" name="phone" value="<?php echo $customer[0][4]; ?>">
                        </div>

                        <div class="input-field col s6">
                            Address:
                            <input type="text" name="address" value="<?php echo $customer[0][6]; ?>">
                        </div>

                        <div class="input-field col s6">
                            zipcode:
                            <input type="text" name="zipcode" value="<?php echo $customer[0][7]; ?>">
                        </div>

                        <div class="input-field col s6">
                            City:
                            <input type="text" name="city" value="<?php echo $customer[0][9]; ?>">
                        </div>

                        <div class="input-field col s12">
                            Email:
                            <input type="text" name="email" maxlength="30" value="<?php echo $customer[0][5]; ?>" />
                        </div>
                        <input type="hidden" name="pass" value="<?php echo $customer[0][3]; ?>">
                        <br>
                        <input type="hidden" name="token" value="<?php echo $token; ?>" />
                        <button class="btn waves-effect waves-light" type="submit" name="submit">Update Account</button>
                        <a class="btn red" style="margin-left:62%" href="../index.php">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
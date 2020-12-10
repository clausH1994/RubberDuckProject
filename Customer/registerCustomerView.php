<?php
require_once("../connection/session.php");

$session = new Session();

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];

if (isset($_POST['submit'])) { // Form has been submitted.
    if (!empty($_POST['token'])) {
        if (hash_equals($_SESSION['token'], $_POST['token'])) {
            unset($_SESSION['token']);
            require_once("CustomerController.php");
            $customerCon = new CustomerController();
            $customerCon->registerCustomer($_POST["fname"], $_POST["lname"], $_POST["phone"], $_POST["address"],  $_POST["zipcode"],  $_POST["city"], $_POST["email"],  $_POST["pass"]);
        } else {
            die('CSRF VALIDATION FAILED');
        }
    } else {
        die('CSRF TOKEN NOT FOUND. ABORT');
    }
}
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <div class="container">

            <div>
                <h2>Register as Customer</h2>

                <form class="col s12" method="post">
                    <div class="row">
                        <div class="input-field col s6">
                            First Name:
                            <input type="text" name="fname" value="">
                        </div>

                        <div class="input-field col s6">
                            Last Name:
                            <input type="text" name="lname" value="">
                        </div>

                        <div class="input-field col s6">
                            Phone Number:
                            <input type="text" name="phone" value="">
                        </div>

                        <div class="input-field col s6">
                            Address:
                            <input type="text" name="address" value="">
                        </div>

                        <div class="input-field col s6">
                            zipcode:
                            <input type="text" name="zipcode" value="">
                        </div>

                        <div class="input-field col s6">
                            City:
                            <input type="text" name="city" value="">
                        </div>

                        <div class="input-field col s6">
                            Email:
                            <input type="text" name="email" maxlength="30" value="" />
                        </div>

                        <div class="input-field col s6">
                            Password:
                            <input type="password" name="pass" maxlength="30" value="" />
                        </div>
                        <br>
                        <input type="hidden" name="token" value="<?php echo $token; ?>" />
                        <button class="btn waves-effect waves-light" type="submit" name="submit" value="Create">Register As Customer</button>
                        <a class="btn red" style="margin-left:62%" href="customerLoginView.php">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
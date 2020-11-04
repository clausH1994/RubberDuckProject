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

                <form action="" method="post">
                    First Name:
                    <input type="text" name="fname" value="">
                    Last Name:
                    <input type="text" name="lname" value="">
                    Phone number:
                    <input type="text" name="phone" value="">
                    Address:
                    <input type="text" name="address" value="">
                    zipcode:
                    <input type="text" name="zipcode" value="">
                    City:
                    <input type="text" name="city" value="">
                    Email:
                    <input type="text" name="email" maxlength="30" value="" />
                    Password:
                    <input type="password" name="pass" maxlength="30" value="" />
                    <br> 
                    <button class="btn waves-effect waves-light" type="submit" name="submit" value="Create">ADD Employee</button>
                    <button class="btn alert" style="background-color: red; color:white; margin:20px" type="submit" name="submit" value="Create">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <?php 
    
if (isset($_POST['submit'])) { // Form has been submitted.
    require_once("CustomerController.php");
    $customerCon = new CustomerController();
    $customerCon->registerCustomer($_POST["fname"], $_POST["lname"], $_POST["phone"], $_POST["address"],  $_POST["zipcode"],  $_POST["city"], $_POST["email"],  $_POST["pass"]);
}
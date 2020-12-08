<?php require_once("AdminLoginHandle.php");

spl_autoload_register(function ($class) {
    include "../connection/" . $class . ".php";
});

$session = new Session();
$log = new AdminLoginHandle();
//look for logout keyword and log the user out if == 1
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    $log->adminLogout();
    $msg = "You are now logged out.";
} elseif ($session->adminlogged_in()) {
    $redirect = new Redirector("../Backend/index.php");
}
$log->checkforAdmin();

if (isset($_POST['submit'])) { // Form has been submitted.

    $regexp = "/^[^0-9][A-z0-9_-]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_-]+)*[.][A-z]{2,4}$/";
    if (!preg_match($regexp, $_POST['email'])) {
        echo "<p style='color: red; font-size: 20px;'>please enter a valid mail</p>";
    } else {

        $log->adminLogin($_POST['email'], $_POST['pass']);
        $msg = $log->message;
    }
}

$secret = "6LeuRP4ZAAAAAN9mLfTK-Zobdg9T_HSNjzyRUWcy";

$response = $_POST["g-recaptcha-response"];

$getstuff = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response);

$success = json_decode($getstuff,true);

    if($success['success']){}
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" />
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body>
    <div class="center">
        <div>

            <?php
            if (!empty($msg)) {
                echo "<p>" . $msg . "</p>";
            }
            ?>
            <h2>Please login</h2>
            <form method="post">
                email:
                <input type="text" name="email" maxlength="30" required />
                Password:
                <input type="password" name="pass" maxlength="30" required />
                <br><br>
                <form action="?" method="POST">
                    <div class="g-recaptcha" data-sitekey="6LeuRP4ZAAAAAANkHDXiiy7BfX-wB-TKUCWvqO58"></div>
                    <br/>
                    <input type="submit" value="Submit" type="submit" name="submit">
                </form>
            </form>
        </div>
    </div>
</body>

</html>

<script>
    function onSubmit(token) {
        document.getElementById("demo-form").submit();
    }
</script>
<?php require_once("../connection/conn.php"); ?>
<?php require_once("../connection/session.php"); ?>
<?php require_once("../connection/functions.php"); ?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="center">

<?php
	// START FORM PROCESSING
	if (isset($_POST['submit'])) { // Form has been submitted.
		$email = trim(mysqli_real_escape_string($connection, $_POST['email']));
		$password = trim(mysqli_real_escape_string($connection,$_POST['pass']));

		$query = "SELECT id, email, pass FROM employee WHERE email = '{$email}' LIMIT 1";
		$result = mysqli_query($connection, $query);
			
			if (mysqli_num_rows($result) == 1) {
				// username/password authenticated
				// and only 1 match
				$found_employee = mysqli_fetch_array($result);
                if(password_verify($password, $found_employee['pass'])){
				    $_SESSION['admin_id'] = $found_employee['id'];
				    $_SESSION['admin'] = $found_employee['email'];
				    redirect_to("../index.html");
			} else {
				// username/password combo was not found in the database
				$message = "Username/password combination incorrect.<br />
					Please make sure your caps lock key is off and try again.";
			}}
	} else { // Form has not been submitted.
		if (isset($_GET['logout']) && $_GET['logout'] == 1) {
			$message = "You are now logged out.";
		} 
	}
if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>

    <div>
    <h2>Please login</h2>
    <form action="" method="post">
        Email:
        <input type="text" name="email" maxlength="30" value="" />
        Password:
        <input type="password" name="pass" maxlength="30" value="" />
        <input type="submit" name="submit" value="Login" />
    </form>
    </div>
</body>
</html>
<?php require_once("../connection/session.php"); ?>
<?php require_once("../connection/conn.php"); ?>
<?php require_once("../connection/functions.php"); ?>
<?php require_once("employeeController.php"); ?>
<?php confirm_adminlogged_in(); ?>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
	<link rel="stylesheet" href="../css/style.css">
</head>

<body>
	<div class="headerAdmin">
		<form method="post">
			<input id="btnLogout" type="submit" name="logout" value="Logout" />
		</form>

		<?php
		if (isset($_POST['logout'])) {
			logout();
		} ?>
	</div>
	<div class="center">
		<div>
			<?php
			// START FORM PROCESSING
			if (isset($_POST['submit'])) { // Form has been submitted.

				// perform validations on the form data
				$email = trim(mysqli_real_escape_string($connection, $_POST['email']));
				$password = trim(mysqli_real_escape_string($connection, $_POST['pass']));
				$iterations = ['cost' => 15];
				$hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);

				$query = "INSERT INTO `employee` (email, pass) VALUES ('{$email}', '{$hashed_password}')";
				$result = mysqli_query($connection, $query);
				if ($result) {
					$message = "employee Created.";
				} else {
					$message = "employee could not be created.";
					$message .= "<br />" . mysqli_error($connection);
				}
			}

			if (!empty($message)) {
				echo "<p>" . $message . "</p>";
			}
			?>
			<div>
				<h2>Create New Employee</h2>

				<form action="" method="post">
					First Name:
					<input type="text" name="fname" value="">
					Last Name:
					<input type="text" name="lname" value="">
					Email:
					<input type="text" name="email" maxlength="30" value="" />
					Password:
					<input type="password" name="pass" maxlength="30" value="" />
					<input type="submit" name="submit" value="Create" />
				</form>
			</div>
		</div>
	</div>
	<?php readEmployees($connection); ?>
	<?php
	if (isset($_POST['delete'])) {
		$em_id = $_POST["em_id"];

		deleteEmployees($em_id, $connection);
	}
	if (isset($_POST['edit']))  {
		$em_id = $_POST["em_id"];
		redirect_to('employeeEdit.php');
	}
	mysqli_close($connection);
	?>

	
</body>

</html>

</body>
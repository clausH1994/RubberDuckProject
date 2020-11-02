<?php spl_autoload_register(function ($class) {
	include "../connection/" . $class . ".php";
}); ?>

<?php $session = new Session();
if ($session->confirm_adminlogged_in()) {
	$redirect = new Redirector("adminLoginView.php");
} ?>

<?php require_once("adminLoginHandle.php");
?>
<?php require_once("employeeController.php"); ?>


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
			$log = new adminLoginHandle();
			$log->adminLogout();
		} ?>
	</div>
	<div class="center">
		<div>

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

	<?php
	// START FORM PROCESSING
	if (isset($_POST['submit'])) { // Form has been submitted.
		
	}

	if (!empty($message)) {
		echo "<p>" . $message . "</p>";
	}
	?>

	<?php // readEmployees($connection); 
	?>
	<?php
	if (isset($_POST['delete'])) {
		$em_id = $_POST["em_id"];
	}
	if (isset($_POST['edit'])) {
		$em_id = $_POST["em_id"];
	}
	?>


</body>

</html>

</body>
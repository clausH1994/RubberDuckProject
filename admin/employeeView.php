<?php
require_once("employeeController.php");
require_once("adminLoginHandle.php");
?>
<?php spl_autoload_register(function ($class) {
	include "../connection/" . $class . ".php";
}); ?>


<?php $session = new Session();
if ($session->confirm_adminlogged_in()) {
	$redirect = new Redirector("adminLoginView.php");
} ?>




<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
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
			$redirect = new Redirector("adminLoginView.php");
		} ?>
	</div>

	<div class="container">
		<div class="row">
			<div class="row">
				<table class="highlight">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>

					<tbody>
						<?php
						$employeeCon = new employeeController();
						$employeeCon->readEmployees();
						?>
					</tbody>
				</table>
			</div>


			<div>
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
							<button class="btn waves-effect waves-light" type="submit" name="submit" value="Create">ADD Employee</button>
						</form>
					</div>
				</div>
			</div>



			<?php

			// START FORM PROCESSING
			if (isset($_POST['submit'])) { // Form has been submitted.

				$employeeCon->createEmployee($_POST["fname"], $_POST["lname"], $_POST["email"], $_POST["pass"]);
			}


			?>

		</div>
	</div>
</body>

</html>

</body>
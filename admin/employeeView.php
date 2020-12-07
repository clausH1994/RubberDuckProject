<?php
require_once("employeeController.php");
require_once("AdminLoginHandle.php");
require("adminHeader.php");
?>
<?php spl_autoload_register(function ($class) {
	include "../connection/" . $class . ".php";
}); ?>

<html>

<body>
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
						$employeeCon->readEmployees($token);
						?>
					</tbody>
				</table>
			</div>


			<div>
				<div>

					<div>
						<h2>Create New Employee</h2>

						<?php

						// START FORM PROCESSING
						if (isset($_POST['submit'])) { // Form has been submitted.
							$regexp = "/^[^0-9][A-z0-9_-]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_-]+)*[.][A-z]{2,4}$/";
							if (!preg_match($regexp, $_POST['email'])) {
						?> <p style="color: red; font-size: 20px;">please enter a valid mail</p>
						<?php
							} else {
								if (!empty($_POST['token'])) {
									if (hash_equals($_SESSION['token'], $_POST['token'])) {
										unset($_SESSION['token']);
										$employeeCon->createEmployee($_POST["fname"], $_POST["lname"], $_POST["email"], $_POST["pass"]);
									} else {
										die('CSRF VALIDATION FAILED');
									}
								} else {
									die('CSRF TOKEN NOT FOUND. ABORT');
								}
							}
						}


						?>

						<form action="" method="post">
							First Name:
							<input type="text" name="fname" value="" required />
							Last Name:
							<input type="text" name="lname" value="" required />
							Email:
							<input type="text" name="email" maxlength="30" value="" required />
							Password:
							<input type="password" name="pass" maxlength="30" value="" required />
							<input type="hidden" name="token" value="<?php echo $token; ?>" />
							<button class="btn waves-effect waves-light" type="submit" name="submit" value="Create">ADD Employee</button>
						</form>
					</div>
				</div>
			</div>




		</div>
	</div>
</body>

</html>

</body>
<?php
require_once("employeeController.php");
require_once("AdminLoginHandle.php");

 spl_autoload_register(function ($class) {
	include "../connection/" . $class . ".php";
}); 



$employeeCon = new employeeController();

// START FORM PROCESSING
if (isset($_POST['submit'])) { // Form has been submitted.
	$regexp = "/^[^0-9][A-z0-9_-]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_-]+)*[.][A-z]{2,4}$/";
	if (!preg_match($regexp, $_POST['email'])) {
?> <p style="color: red; font-size: 20px;">please enter a valid mail</p>
<?php
	} else {
		$employeeCon->createEmployee($_POST["fname"], $_POST["lname"], $_POST["email"], $_POST["pass"]);
	}
}

require("adminHeader.php");

?>

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
							<input type="text" name="fname" value="" required />
							Last Name:
							<input type="text" name="lname" value="" required />
							Email:
							<input type="text" name="email" maxlength="30" value="" required />
							Password:
							<input type="password" name="pass" maxlength="30" value="" required />
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
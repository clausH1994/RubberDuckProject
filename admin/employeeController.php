<?php require_once("../connection/functions.php"); ?>
<?php require_once("../connection/conn.php"); ?>
<?php

function logout()
{
	// Four steps to closing a session
	// (i.e. logging out)

	// 1. Find the session
	session_start();

	// 2. Unset all the session variables
	$_SESSION = array();

	// 3. Destroy the session cookie
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time() - 42000, '/');
	}

	// 4. Destroy the session
	session_destroy();

	redirect_to("admin.php?logout=1");
}

function readEmployees($connection)
{
	$query = "SELECT * FROM employee";
	$result = mysqli_query($connection, $query);

	while ($row = mysqli_fetch_array($result)) {
		echo
			$row['fname'] . " " .
				$row['lname'] . " " .
				$row['email'];
?>
		<form method="post">
			<input type="hidden" name="em_id" value="<?php echo $row['employeeID'] ?>">
			<input class="btnEditEmployee" type="submit" name="edit" value="edit" />
			<input class="btnDeleteEmployee" type="submit" name="delete" value="delete" />
		</form>
<?php
		"<br>";
	}
}
 
function deleteEmployees($em_id, $connection)
{
	$query = "DELETE FROM `employee` WHERE `employee`.`employeeID`='$em_id'";
	mysqli_query($connection, $query) or die('Error, query failed');

	redirect_to("employeeOverview.php");
}

function editEmployee($em_id, $connection)
{
	echo "edit";
}
<?php require_once("../connection/functions.php"); ?>
<?php require_once("../connection/conn.php"); ?>
<?php



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

	
}

function editEmployee($em_id, $connection)
{
	echo "edit";
}
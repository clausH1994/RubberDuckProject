
<?php
spl_autoload_register(function ($class) {
	include "../connection/" . $class . ".php";
});

require_once("EmployeeDAO.php");

class employeeController
{

	public function readEmployeeById($emId)
	{
		$employeeDAO = new EmployeeDAO();
		$result = $employeeDAO->readEmployeeByIdDB($emId);

		return $result;
	}


	public function createEmployee($fname, $lname, $email, $pass)
	{
		$employeeDAO = new EmployeeDAO();
		$email = trim($email);
		$pass = trim($pass);
		$iterations = ['cost' => 15];
		$hashed_password = password_hash($pass, PASSWORD_BCRYPT, $iterations);
		$employeeDAO->createEmployeeDB($fname, $lname, $email, $hashed_password);
		$redirect = new Redirector("employeeView.php");
	}

	public function readEmployees()
	{
		$employeeDAO = new EmployeeDAO();
		$employees = $employeeDAO->readEmployeeDB();

		$this->templateEmployee($employees);
	}



	public function editEmployee($emID, $fname, $lname, $email, $pass)
	{
		$employeeDAO = new EmployeeDAO();
		$employeeDAO->UpdateEmployeeDB($emID, $fname, $lname, $email, $pass);
		$redirect = new Redirector("employeeView.php");
	}

	public function deleteEmployee($emID)
	{
		$employeeDAO = new EmployeeDAO();
		$employeeDAO->deleteEmployeeDB($emID);
		$redirect = new Redirector("employeeView.php");
	}

	private function templateEmployee($row)
	{

		foreach ($row as $row) {
			echo "<tr>";
			echo "<td>" . $row->fname . " " . $row->lname . "</td>";
			echo "<td>" . $row->email . "</td>";
			echo '<td><a href="employeeEditView.php?ID=' . $row->employeeID . '" class="waves-effect waves-light btn" ">Edit</a></td>';
			echo '<td><a href="employeeDelete.php?ID=' . $row->employeeID . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';
			echo "</tr>";
		}
	}
}

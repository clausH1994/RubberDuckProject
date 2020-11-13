<?php
class Session
{
	public function __construct()
	{
		session_start();
	}

	public function adminlogged_in()
	{
		return isset($_SESSION['admin_id']);
	}

	public function confirm_adminlogged_in()
	{
		if (!$this->adminlogged_in()) {
			$redirect = new Redirector("../admin/adminLoginView.php");
		}
	}
}
?>

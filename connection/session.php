<?php
require_once("Redirector.php");
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

	public function userLogged_in()
	{
		return isset($_SESSION['user_id']);
	}

	public function confirm_userlogged_in()
	{
		if (!$this->userlogged_in()) {
			$redirect = new Redirector("../customer/customerLoginView.php");
		}
	}
}
?>

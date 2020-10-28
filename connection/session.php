<?php
class Session
{
function __construct()
{
	session_start();
}
	
	function adminlogged_in() {
		return isset($_SESSION['admin_id']);
    }
    
	function confirm_adminlogged_in() {
		if (!$this->adminlogged_in()) {
            $redirect = new Redirector("employeeOverview.php");
        }
	}
}

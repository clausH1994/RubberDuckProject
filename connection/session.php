<?php
	session_start();
	
	function logged_in() {
		return isset($_SESSION['admin_id']);
    }
    
	function confirm_adminlogged_in() {
		if (!logged_in()) {
			redirect_to("../admin/admin.php");
		}
	}
?>

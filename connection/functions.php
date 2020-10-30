<?php
	require_once "dbcon.php";

	function redirect_to($location) {
			header("Location: {$location}");
			exit;
	}

	function mysql_prep( $value ) {
		//var_dump(dbCon("",""));
		//var_dump($dbCon);
		//$value = dbCon("","")->real_escape_string(htmlspecialchars(trim($value)));
		return $value;
	}
?>


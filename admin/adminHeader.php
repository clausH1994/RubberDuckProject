<?php

spl_autoload_register(function ($class) {
    include "../connection/" . $class . ".php";
});

require_once("AdminLoginHandle.php");

$session = new Session();
if ($session->confirm_adminlogged_in()) {
    $redirect = new Redirector("../admin/adminLoginView.php");
} ?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<link rel="stylesheet" href="../css/style.css">
</head>

<div class="headerAdmin">
    <form method="post">
        <input id="btnLogout" type="submit" name="logout" value="Logout" />
    </form>

    <?php
    if (isset($_POST['logout'])) {
        $log = new adminLoginHandle();
        $log->adminLogout();
        $redirect = new Redirector("adminLoginView.php");
    } ?>
</div>
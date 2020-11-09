<?php

spl_autoload_register(function ($class) {
    include "../connection/" . $class . ".php";
});

require_once("AdminLoginHandle.php");

$session = new Session();
if ($session->confirm_adminlogged_in()) {
    $redirect = new Redirector("adminLoginView.php");
} ?>

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
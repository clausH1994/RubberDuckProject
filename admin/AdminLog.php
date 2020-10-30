<?php

require_once("admin.php");
require_once("../connection/dbcon.php");

class AdminLog
{
    public $message;
    

    public function __construct()
    {
        
    }

    public function adminLogin($email, $password)
    {
        $db = dbCon($user, $pass);
        $email = trim($email);
        $pass = trim($password);
        $query = $db->dbCon->prepare("SELECT id, email, pass FROM users WHERE email = '{$email}' LIMIT 1");
        if ($query->execute()) {
            $found_admin = $query->fetchAll();
            if (count($found_admin) == 1) {
                if (password_verify($pass, $found_admin[0]['pass'])) {
                    $_SESSION['admin_id'] = $found_admin[0]['id'];
                    $_SESSION['admin'] = $found_admin[0]['email'];
                    $redirect = new Redirector("employeeOverview.php");
                } else {
                    // username/password combo was not found in the database
                    $this->message = "Email/password combination incorrect.<br />
					Please make sure your caps lock key is off and try again.";
                }
            } else {
                $this->message = "No such Email in the database.<br />
				Please make sure your caps lock key is off and try again.";
            }
        }
    }

    public function adminLogout()
    {
        // Four steps to closing a session
        // (i.e. logging out)

        // 1. Find the session
        // This is done with session_start()
        // in the session handle class

        // 2. Unset all the session variables
        $_SESSION = array();

        // 3. Destroy the session cookie
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }

        // 4. Destroy the session
        session_destroy();
    }
}

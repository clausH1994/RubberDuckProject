<?php
<?php require_once("../connection/dbcon.php"); ?>
class Admin
{
    public $message;

    function __construct()
    {
        
    }

    function login()
    {
        $db = dbCon($user, $pass);
        $email = trim($username);
        $pass = trim($password);
        $query = $db->dbCon->prepare("SELECT id, user, pass FROM users WHERE user = '{$user}' LIMIT 1");
        if($query->execute()){
            $found_user = $query->fetchAll();
            if (count($found_user)==1){
                if(password_verify($pass, $found_user[0]['pass'])){
                    $_SESSION['user_id'] = $found_user[0]['id'];
                    $_SESSION['user'] = $found_user[0]['user'];
                    $redirect = new Redirector("frontpage.php");
                } else {
                    // username/password combo was not found in the database
                    $this->message = "Username/password combination incorrect.<br />
					Please make sure your caps lock key is off and try again.";
                }
            }else{
                $this->message = "No such Username in the database.<br />
				Please make sure your caps lock key is off and try again.";
            }
    }

    function logout()
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

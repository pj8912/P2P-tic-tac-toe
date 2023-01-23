<?php 
session_start();
?>
<?php
require_once '../vendor/autoload.php';

use Ttc\Database\Database;
use Ttc\Models\User;

// error correction
error_reporting(E_ALL);
ini_set('display_errors', 'On');

if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {

    if (isset($_POST['lbtn'])) {

        $uname = strip_tags($_POST['uname']); //username
        $pwd = strip_tags($_POST['pwd']); //password
        
        $database = new Database();
        $db = $database->connect();

        $user = new User($db);

        $user->username = $uname;

        $result = $user->check_user();
        $num = $result->rowCount();

        if ($num > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                
                $hashedPwd = $row['user_pwd'];

                $hashedPwdCheck = password_verify($pwd, $hashedPwd);

                if ($hashedPwdCheck == false) {
                    header("Location: ../index.php?login=error");
                    exit();
                } else {

                    $_SESSION['u_id'] = $row['user_id'];
                    header('Location: ../index.php');
                    exit();   
                }
            }
        }
        else {
            header('Location: ../index.php?email=err');
            exit();
        } 

    }
}
else {
    echo "REQUEST_METHOD_ERROR";
}

?>



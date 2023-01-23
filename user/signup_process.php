<?php

require_once '../vendor/autoload.php';
use Ttc\Database\Database;
use Ttc\Models\User;

error_reporting(E_ALL);
ini_set('display_errors', 'On');



if (isset($_POST['sbtn'])) {


    // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $name = htmlentities(strip_tags($_POST['flname']));
    $uname = htmlentities(strip_tags($_POST['uname']));
    $pwd = strip_tags($_POST['pwd']);

    if (empty($uname)) {
        header("Location: ../index.php?error=empty");
        exit();
    } else {
   
        $db = new Database();
        $db = $db->connect();
        $user = new User($db);
        
        $user->fullname = $name;
        $user->username = $uname;
        
        $result = $user->check_user();
        $num = $result->rowCount();
        
        if ($num > 0) {
            header('Location: ../index.php?err=username_exists');
            exit();
            
        } else {
            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
            $user->pwd = $hashedPwd;
            //create user
            $user->createUser();
            header("Location: ../index.php?signup=success");
            exit();
        }
    }
} else {
    header('Location: ../index.php');
    exit();
}


?>

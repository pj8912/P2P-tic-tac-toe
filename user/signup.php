<?php 
session_start();

require_once '../vendor/autoload.php';


use TTC\Database\Database;
use TTC\Models\User;

require_once '../includes/Template.php';

main_header('SignUp'); //header

?>


<div class="container">
        <div class="bg-white mt-5 card card-body col-md-4 m-auto login-form">
			<p align="center" class="h1 p-1">tic-tac-toe</p><br>
            <form action="signup.php" method="post">
                <div class="mb-2">
                    <input class="form-control" autocomplete="off"  type="text" name="flname" placeholder="FullName*" required>
                </div>
                <div class="mb-2">
                    <input class="form-control" autocomplete="off"  id="email" type="email" name="email" placeholder="Email*" required>
                </div>
                <div class="mb-2">
                    <input class="form-control" autocomplete="off"  type="password" name="pwd" placeholder="Password*" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" name="sbtn" class="btn btn-success" align="center">
                        Sign Up
                    </button>
                </div>
                <p class="text-center mt-3">Already have an account? <a href="../index.php">Log in</a></p>
            </form>
        </div>
    </div>
</div>

<?php
// footer
main_footer();
?>


<?php

if(isset($_SERVER['REQUEST_METHOD']) == 'POST') {

    if (isset($_POST['sbtn'])) {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $name = htmlentities(strip_tags($_POST['flname']));
        $uname  = htmlentities(strip_tags($_POST['uname']));
        $email = htmlentities(strip_tags($_POST['email']));
        $pwd = strip_tags($_POST['pwd']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../index.php?error=empty");
            exit();
        } else {

            $db = new Database();
            $db = $db->connect();
            $user = new User($db);
            $user->fullname = $name;
            $user->email = $email;
            $user->username = $uname;

            $result = $user->check_user();
            $num = $result->rowCount();
            if ($num > 0) {
                header('Location: ../index.php');
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
} else {
    header('Location: ../index.php');
    exit();
}

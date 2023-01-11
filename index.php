<?php session_start();?>
<?php
require_once 'includes/Template.php';
main_header('Home');
?>


<div class="container">

    <?php if (isset($_SESSION['u_id'])) : ?>
        <div class=" mt-5" align="center">
            <a class="btn btn-danger text-center rounded-0" href="user/logout.php">logout</a>
        </div>
    <?php endif; ?>
        
    
    <?php if (!isset($_SESSION['u_id'])) : ?>

        <div class="bg-white mt-5 card card-body col-md-4 m-auto login-form">
            <p align="center" class="h1 p-1">tic-tac-toe</p><br>
            <form action="user/login.php" method="post">

                <div class="mb-2">
                    <input type="text" name="email" class='form-control' placeholder="Username*" required>
                </div>
                <div class="mb-2">
                    <input type="password" name="pwd" class='form-control' placeholder="Password" required>
                </div>
                <div class="d-grid gap-2" align="center">
                    <button name="lbtn" type="submit" class="btn btn-primary ">
                        login
                    </button>
                </div>

            </form>
            <p align="Center" class="mt-5"> Don't Have and account? <a href="user/signup.php">Sign Up</a> </p>
        </div>

    <?php endif; ?>



</div>
        




<?php

main_footer();
?>
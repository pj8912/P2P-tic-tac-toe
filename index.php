<?php session_start(); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">


<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<?php if (isset($_SESSION['u_id'])) : ?>
            <div class=" mt-5" align="center">

                <a class="btn btn-danger text-center rounded-0" href="user/logout.php">logout</a>
            </div>
<?php endif; ?>




<?php if (!isset($_SESSION['u_id'])) : ?>

<!-- login -->
<div class="container">
    <div class="bg-white mt-5 card card-body col-md-6 m-auto login-form">
        <p align="center" class="h1 p-1">Authentication</p><br>

<h4 class="mt-4">Login</h3>
        <form action="user/login.php" method="post">

            <div class="mb-2">
                <input type="text" name="uname" class='form-control' placeholder="Username">
            </div>
            <div class="mb-2">
                <input type="password" name="pwd" class='form-control' placeholder="Password">
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

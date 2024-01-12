<?php 
session_start();
include_once "../includes/header.php"; 
include_once "../includes/database.php";
include_once "../includes/model.php";
include_once "../includes/authController.php";
?>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
            <div class="tgs_logo">
                    <img src="../assets/img/icons/logo.png" alt="">
                </div>
            <div class="app-brand justify-content-center">
              </div>
                <form method="POST" autocomplete="">
                    <h2 class="text-center">Change Password</h2>
                    <p class="text-center">It's quick and easy.</p>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="change-password" value="Change Password">
                    </div>
                    <div class="link login-link text-center">Already a member? <a href="login-user.php">Login here</a></div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>
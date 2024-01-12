<?php 
session_start();
include_once "../includes/header.php"; 
include_once "../includes/database.php";
include_once "../includes/model.php";

$user = new model();

  if(isset($_POST['login']))
  {
		$email = $_POST['email'];
    $password = $_POST['pass'];
	  $user->login($email, $password);
  }

?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <div class="tgs_logo">
                    <img src="../assets/img/icons/logo.png" alt="">
                </div>
                <form  method="POST" autocomplete="">
                    <h2 class="text-center">Login Form</h2>
                    <p class="text-center">Login with your email and password.</p>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="pass" placeholder="Password" required>
                    </div>
                    <div class="link forget-pass text-left"><a href="forgot-password.php">Forgot password?</a></div>
                    <div class="form-group">
                    <input type='submit' name='login' value='Login' class="form-control button"><br>
                    </div>
                    <div class="link login-link text-center">Not yet an Event Organizer?</div>
                    <div class="link login-link text-center">Contact <a href="../../contact.php">Try Bae</a></div>
                </form>
                <?php
                                                    if(isset($_SESSION['error']))
                                                    {
                                                          ?>
                                                          <div class="alert alert-danger text-center" style="margin-top:20px;">
                                                            <?php echo $_SESSION['error']; ?>
                                                          </div>
                                                          <?php
                                                          unset($_SESSION['error']);
                                                        }

                                                        if(isset($_SESSION['success']))
                                                        {
                                                          ?>
                                                          <div class="alert alert-success text-center" style="margin-top:20px;">
                                                          <?php echo $_SESSION['success']; ?>
                                                          </div>
                                                          <?php
                                                          unset($_SESSION['success']);
                                                        }
                                                      ?>                
            </div>
        </div>
    </div>
    
</body>
</html>
<?php 

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

//Instance of the class
require_once 'model.php';
require_once 'database.php';  
$model = new model();

$errors  = array();




    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $check_email = "SELECT * FROM users WHERE email='$email'";
        $run_sql = mysqli_query($conn, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE users SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($conn, $insert_code);
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: chiyembekezop11@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent a passwrod reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }
   

    //if user click check reset otp button
    if(isset($_POST['reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = $_POST['otp'];
        $check_code = $model->getUserOTP($otp_code);
        if($check_code == true){
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = " $email - Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: change-password.php');    
            exit();
        }
        else
        {
           echo "<script>Alert('You've entered incorrect code!')</script>";
        }
    }

    //if user click change password button

    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $email = $_SESSION['email']; 
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $model->changePassword($email, $encpass);
        }
    }


    if(isset($_POST['reset-password'])){
        $email = $_POST['email'];
        $email_check =  $model->checkEmail($email);
        if($email_check == false){
            $errors['email'] = "Email that you have entered does not already exist!";
        }
        else
        {
            $code = rand(999999, 111111);
            $data_check = $model->sendOTP($email, $code);
            $link = "http://localhost/trybae-main/admin/authentication_pages/login-user.php";
            $subject = "Password Rest Code";
            $message = "Your verification code is ".$code."\n\n Use it to access the change password form. \n\n follow the Link below \n\n ".$link." \n\n Thank you!";
            $sender = "From: chiyembekezop11@gmail.com";
            $mail = mail($email, $subject, $message, $sender);
            $info = "We've sent a verification code to your email - $email";
            $_SESSION['info'] = $info;
            $_SESSION['email'] = $email;
            $_SESSION['code'] = $code;
            header('location: ../authentication_pages/reset-otp.php');
            echo"<script>alert('An OTP has Been Sent To Your Email');</script>";
            exit();
            $errors['otp-error'] = "Failed while sending code!";
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    
    }
?>
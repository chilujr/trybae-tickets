<!-- Header Start -->
<?php
session_start();
 include "includes_ui/header.php"; 
#<!-- Navbar Start  -->
include_once ("includes_ui/navbar_ui.php");


if (isset($_POST['submit'])) 
    {
        $name = $_POST['name'];
        $email= $_POST['email'];
        $subject = $_POST['subject'];
        $message= $_POST['message'];
        if(!empty($name) && !empty($email) && !empty($subject) && !empty($message))
        {
            $mail = new mail();
            $mail->send_email($name, $email, $subject, $message);
        }
        else
        {
            $response = "All fields are required";
            $_SESSION['response'] = $response;
        }
    }
    ?>

    <!-- Navbar Ends -->

    <!-- contact section starts  -->
    <div class="hero" style="height: 550px; background-image: url('admin/uploads/1653028672_pexels-pavel-danilyuk-7658431.png');">

        <br>
        <br>
        <br>
        <br>
        <div class="wrp" >
            <h1 class="section_heading text-center" style="color:#fff;">Let's talk about everything.</h1>
            <p class="text-center" style="color:#fff;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil deleniti itaque similique magni. Magni, laboriosam perferendis maxime!</p>
        </div>
        

    </div>
    <br>


        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-10">

                    <div class="row align-items-center">
                        <div class="col-lg-7 mb-5 mb-lg-0">

                            <h2 class="mb-5">Fill the form. It's easy.</h2>
                            <?php if(isset($_SESSION['response']))
                            {?>
                            <div class="alert alert-success" role="alert">
                               <H5 class="text-center"><?=$_SESSION['response'];?></H5>
                            </div>
                            <?php }  unset($_SESSION['response']); ?>
                        </div>
                        <div class="col-md-7">
                            <div class="card" style="background-color:#3D6198; border-radius: 0 !important; padding:20px;">
                                <h1 class="section_heading text-center" style="color:#fff;">Contact Us</h1>
                                <br>
                                <form class="border-right pr-5 mb-5" method="post" id="contactForm" name="contactForm">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <input type="text" class="form-control" name="name" id="fullname" placeholder="Full Name">
                                        </div>
                                        <br>
                                        
                                        <div class="col-md-6 form-group">
                                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <textarea class="form-control" name="message" id="message" cols="30" rows="7" placeholder="Write your message"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" value="Send Message" name="submit" class="btn btn-primary">
                                            <span class="submitting"></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 ml-auto">
                            <h3 class="mb-4">Let's talk about everything.</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil deleniti itaque similique magni. Magni, laboriosam perferendis maxime!</p>
                            <p><a href="#">Read more</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>

    <!-- footer section starts  -->
<?php
    include_once ("includes_ui/footer_ui.php");
?>
    <!-- custom js file link  -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>

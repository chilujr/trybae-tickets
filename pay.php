<!-- Header Start -->
<?php 
session_start();
if(isset($_GET['id']))
{
    $event_id = $_GET['id'];
    $_SESSION['event_id'] = $event_id;
}
include "includes_ui/header.php"; 
#<!-- Navbar Start  -->
include_once ("includes_ui/navbar_ui.php");
?>
<!-- Navbar Ends -->

<!-- Upcoming Events  -->

<section class="price" id="price">

    <h1 class="heading"><span>UpcomingS Events</span> </h1>

    <br/> <br/>

    <div class="container">
        
    <div class="row">
            <div class="col-md-6 offset-md-6 form login-form">
                <div class="tgs_logo">
                    <img src="../assets/img/icons/tgslogo.png" alt="">
                </div>
                <form method="POST" action="payment.php">
                    <h2 class="text-center">Payment Details Form</h2>
                    <p class="text-center">Confirm Payment with your Email and Name.</p>
                    <br>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" placeholder="Customer Name" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <input class="form-control" style="text-transform: none;" type="email" name="email" placeholder="Email Address" required>
                    </div>
                    <br>

                    <div class="form-group">
                        <select class="form-control" type="text" name="amount" required>
                            <option value="">Select Payment Method</option>
                            <?php $single = $model->getSingleEvent($event_id);
                            while ($price = $single->fetch(PDO::FETCH_ASSOC)):?>
                            <?php $_SESSION['event_name'] = $price['event_name'];?>
                            <option value="<?=$price['vip']?>">VIP Ticket - K<?=$price['vip']?></option>
                            <option value="<?=$price['ordinary']?>">Ordinary Ticket - K<?=$price['ordinary']?></option>
                            <?php endwhile;?>
                        </select>
                    </div>
                    <br>

                    <div class="form-group">
                        <button class="btn btn-Primary" name="pay" type="submit" id="start-payment-button">Pay Now</button><br>
                    </div>
                </form>
                <?php
                   if(isset($_SESSION['error'])){?>
                    <div class="alert alert-danger text-center" style="margin-top:20px;">
                       <?php echo $_SESSION['error']; ?>
                    </div>
                    <?php
                        unset($_SESSION['error']);
                    }
                    if(isset($_SESSION['success']))
                    {?>
                    <div class="alert alert-success text-center" style="margin-top:20px;">
                        <?php echo $_SESSION['success']; ?>
                    </div>
                    <?php
                        unset($_SESSION['success']);
                    } ?>                
            </div>
        </div>      
            
    </div>


</section>

<!-- Events Section Ends -->

<!-- footer section starts  -->
<?php
include_once ("includes_ui/footer_ui.php");
?>

<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/main.js"></script>
<script src="js/script.js"></script>

</body>
</html>
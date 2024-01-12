<!-- Header Start -->
<?php
session_start();
include "includes_ui/header.php"; 
#<!-- Navbar Start  -->
include_once ("includes_ui/navbar_ui.php");
// Getting the ID
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $single = $model->getSingleEvent($id);
}
?>
<?php while($row = $single->fetch(PDO::FETCH_ASSOC)):?>
    <div class="hero" style="height:600px; background-image: url('admin/uploads/<?=$row['images']?>');"></div>

    <!-- Navbar Ends -->
    <br />
    <!-- Grid Layout -->
    <!-- Event Details -->
    <div class="container">
        <div class="row">
            
            <div class="col-sm-7">

                <h1><?=$row['event_name']?></h1> <br>
                <h4>About Event</h4><br>

                <p d-flex justify-content-evenly><?=$row['add_info']?>.</p><br>
                <hr><br>

                <h5>Additional Information</h5><br>

                <h6>Category: <span style="color:#3867d6; font-weight:500;"><?=$row['category']?></span></h6>
                <h6>Age Restrictions: <span style="color:#3867d6; font-weight:500;"><?=$row['age']?></span></h6>
                <h6>Refund Policy:&nbsp <span style="color:#3867d6; font-weight:500;">No Refunds</span></h6>
                <br>
                <hr><br>
                <h5>Organizer</h5><br>

                <h1><?=$row['username']?></h1> <br>
            </div>

            <!-- Event Details  End-->
            <div class="col-sm-5">
            <div class="card" style="border-radius: 0 !important;">
                    <div class="card-header">
                        <h5>Ticket Details:</h5>
                    </div>
                    <div class="card-body">
                        <?php $start_date = date('M d, Y H:i:s', strtotime($row['start_time'])); ?>
                        <?php $end_date = date('M d, Y H:i:s', strtotime($row['end_time'])); ?>
                        <h6>Starting: <span style="color:#3867d6; font-weight:500;"><?=$start_date; ?></span> - <span style="color:#3867d6; font-weight:500;"><?=$end_date; ?></span></h6>
                        <br>
                        <h6>Address: <span style="color:#3867d6; font-weight:500;"><?=$row['address']?></span></h6>
                        <?php if($row['attendance_limit'] == 0):?>
                        <br>
                        <a href="#" class="btn btn-primary">Sorry Tickets Are Sold Out</a>
                        <?php else:?>
                        <br>
                        <a href="pay.php?id=<?=$row['id']?>" class="btn btn-primary">Purchase Ticket</a>
                        <?php endif;?>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
<?php endwhile;?>

    <!-- Events Section Ends -->

    <!-- footer section starts  -->
    <?php
include_once ("includes_ui/footer_ui.php");
?>
    <!-- footer section ends -->

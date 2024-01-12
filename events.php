<!-- Header Start -->
<?php include "includes_ui/header.php"; 
#<!-- Navbar Start  -->
include_once ("includes_ui/navbar_ui.php");
?>
<!-- Navbar Ends -->

    <br /> <br /><br /> <br />
    <!-- home section ends -->

    <!-- Ticket Section -->
    <section class="price" id="price">

        <div class="container">

            <!-- First Row -->
            <h1><span>Upcoming Live Events</span> </h1>
            <br> <br>
            <div class="row">
                <?php while($upcoming = $upcoming_events->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="col-sm-3">
                        <div class="card" style="width:280px; border-radius: 0 !important;">
                            <div style="width: 280px; height: 170px;">
                                <img class="card-img-top" style="overflow: hidden; height: 100%; width: 100%;" src="admin/uploads/<?= $upcoming['images'];?>"alt="Card image">
                            </div>
                            <div class="card-body text-center">
                                <h4 class="card-title"style="height: 50px;"><?php echo $upcoming['event_name']; ?></h4>
                                <br />
                                <?php $start_date = date('M d, Y', strtotime($upcoming['start_time'])); ?>
                                <?php $end_date = date('M d, Y', strtotime($upcoming['end_time'])); ?>
                                <p class="card-text">Date: <?=$start_date; ?> - <?=$end_date; ?></p>
                                <h6 class="amount">VIP: <a href="#">K<?=$upcoming['vip'];?></a> - Ordinary: <a href="#">K<?=$upcoming['ordinary'];?></a></h6>
                                <div style="height: 70px;">
                                    <p class="card-text"><?=$upcoming['address'];?></p>
                                </div>    
                                <a href="single.php?id=<?=$upcoming['id']; ?>" class="btn btn-primary">View Info</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>     
            </div>

            <br /> <br /> <br /><hr>

            <!-- Second Row -->
            <h1><span>Upcoming Conferences</span> </h1>
            <br> <br>
            <div class="row">
                <?php while($confrences = $upcoming_confrences->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="col-sm-3">
                        <div class="card" style="width:280px">
                            <div style="width: 280px; height: 170px;">
                                <img class="card-img-top img-rounded" style="height: 100%; width: 100%;" src="admin/uploads/<?=$confrences['images'];?>"alt="Card image">
                            </div>
                            <div class="card-body text-center">
                                <h4 class="card-title"style="height: 50px;"><?php echo $confrences['event_name']; ?></h4>
                                <br />
                                <?php $start_date = date('M d, Y', strtotime($confrences['start_time'])); ?>
                                <?php $end_date = date('M d, Y', strtotime($confrences['end_time'])); ?>
                                <p class="card-text">Date: <?=$start_date; ?> - <?=$end_date; ?></p>
                                <h6 class="amount">VIP: <a href="#">K<?=$confrences['vip'];?></a> - Ordinary: <a href="#">K<?=$confrences['ordinary'];?></a></h6>
                                <div style="height: 70px;">
                                    <p class="card-text"><?=$confrences['address'];?></p>
                                </div>  
                                <a href="single.php?id=<?php echo $confrences['id']; ?>" class="btn btn-primary">View Info</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>    
            </div>
            <br /> <br /> <br /><hr>

            <h1><span>Upcoming Online Events</span> </h1>
        <br> <br><br>

        <div class="row">
            <?php while($onlineEvents = $upcoming_onlineEvents->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="col-sm-3">
                    <div class="card" style="width:280px">
                        <div style="width: 280px; height: 170px;">
                            <img class="card-img-top img-rounded" style="height: 100%; width: 100%;" src="admin/uploads/<?=$onlineEvents['images'];?>"alt="Card image">
                        </div>
                        <div class="card-body text-center">
                            <h4 class="card-title"style="height: 50px;"><?php echo $onlineEvents['event_name']; ?></h4>
                            <br />
                            <?php $start_date = date('M d, Y', strtotime($onlineEvents['start_time'])); ?>
                            <?php $end_date = date('M d, Y', strtotime($onlineEvents['end_time'])); ?>
                            <p class="card-text">Date: <?=$start_date; ?> - <?=$end_date; ?></p>
                            <h6 class="amount">VIP: <a href="#">K<?=$onlineEvents['vip'];?></a> - Ordinary: <a href="#">K<?=$onlineEvents['ordinary'];?></a></h6>
                            <div style="height: 70px;">
                                <p class="card-text"><?=$onlineEvents['address'];?></p>
                            </div>  
                            <a href="single.php?id=<?php echo $onlineEvents['id']; ?>" class="btn btn-primary">View Info</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?> 
        </div>
        </div>


    <!-- End of Second Row -->

    <!-- pagination section ends -->
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

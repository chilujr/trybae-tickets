<!-- Header Start -->
<?php include "includes_ui/header.php"; 
#<!-- Navbar Start  -->
include_once ("includes_ui/navbar_ui.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $category_result = $model->getCategories($id);
}
?>

    <!-- Navbar Ends -->

    <div class="container">
        <div class="row">
            <h1><span>Category Result(s):</span> </h1>
                    <br> <br>
            <?php while($category =  $category_result->fetch(PDO::FETCH_ASSOC)):?>
                <div class="col-sm-7">

                    <br> <br>
                    
                    <div class="hero" style="height: 400px; background-image: url('admin/uploads/<?=$category['images']?>.');"></div>
                    <br><br>

                    <h1><a href="single.php?id=<?=$category['id'];?>" style="color:black;"><?=$category['event_name']?></a></h1> <br>
                    <h3><a href="category.php?id=<?=$category['category_id']?>"><?=$category['category']?></a></h3>
                    <br>
                    <h4>About Event</h4><br>

                    <p d-flex justify-content-evenly><?=$category['add_info']?></p> <br> <br>


                    <hr><br>           

                </div>
            <?php endwhile?>

            <div class="col-sm-5">
            <hr><br>
            <h1>Space for Adverts</h1> <br>
        </div>

        </div>
    </div>
    <!-- Events Section Ends -->

    <br /> <br /><br /> <br />

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


<footer class="footer-59391">
    <div class="border-bottom pb-5 mb-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <form class="subscribe mb-4 mb-lg-0" method="POST">
                        <!--SEARCH-->
                        <div class="form-group" >
                        <?php if(isset($_SESSION['search'])){
                                $get = $_SESSION['search'];
                            } else{
                                $get = "";
                            }?>
                           <input type="text" class="form-control" name="search" placeholder="Search For Events">
                            <button  type="submit" name="btn_search"><span class="icon-keyboard_backspace"></span></button> 
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 text-lg-center">
                    <ul class="list-unstyled nav-links nav-left mb-4 mb-lg-0">
                        <li><a href="events.php">Browse Events</a></li>
                        <li><a href="contact.php">Become a Event Organizer</a></li>
                        <li><a href="about_us.php">About Us</a></li>
                    </ul>
                </div>

                <div class="col-lg-3">
                    <ul class="list-unstyled nav-links social nav-right text-lg-right">
                        <li><a href="#"><span class="icon-twitter"></span></a></li>
                        <li><a href="#"><span class="icon-instagram"></span></a></li>
                        <li><a href="#"><span class="icon-facebook"></span></a></li>
                        <li><a href="#"><span class="icon-pinterest"></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 text-lg-center site-logo order-1 order-lg-2 mb-3 mb-lg-0">
                <img src="images/browser_icon.png" class="img-fluid" style="width: 90px; height: 24px;">
            </div>
            <div class="col-lg-4 order-2 order-lg-1 mb-3 mb-lg-0">
                <ul class="list-unstyled nav-links m-0 nav-left">
                    <li><a href="#">Terms</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>

            <div class="col-lg-4 text-lg-right order-3 order-lg-3">
                <p class="m-0 text-muted"><small style="color:#fff;">&copy; 2022. All Rights Reserved.</small></p>
            </div>
        </div>
    </div>

</footer>

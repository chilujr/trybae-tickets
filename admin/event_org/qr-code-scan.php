<?php 
require_once "includes/sessions.php"; 
require_once "includes/event_controller.php";
require_once "includes/database.php";
require_once "includes/model.php";
require_once "includes/header.php";

$model = new model();
$id = $_SESSION['id'];
$transaction = $model->getAllTransactions($id);

if(isset($_POST['verify'])){
  if(empty($_POST['id'])){
   echo"<script>alert('Transaction ID Error')</script>";
  }else{
  $id = $_POST['id'];
  $verify = $model->verifyTransaction($id);
  }

}


?>
  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <?php require_once "includes/menu.php"; ?>
        
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <?php require_once "includes/nav.php"; ?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Action /</span>View Transactions</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link" href="add-events.php"><i class="bx bx-plus me-1"></i> Add Events</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="view-events.php"
                        ><i class="bx bx-bell me-1"></i>View Events</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="ticket_purchase.php"
                        ><i class="bx bx-bell me-1"></i>View Transactions</a
                      >
                    </li>
                  </ul>
                  <!-- Basic Bootstrap Table -->
                  <div class="card">
                  <div class="container">
                  <h5 class="card-header">Scan QR-Code</h5>
                      
                    <form method="POST" enctype="">
                      <div class="row">
                      <div class="mb-3 col-md-4">
                      <center><p class="login-box-msg"> <i class="glyphicon glyphicon-camera"></i> TAP HERE</p></center>
                        <div class="mb-3 preview-container">
                          <video id="preview" width="100%" height="100%"></video>
                        </div>
                        <br><br>
                      </div>
                      
                      <div class="mb-3 col-md-8">
                      <?php if(isset($_POST['verify'])){?>
                        <label for="organization" class="form-label">Transaction ID</label>
                        <input class="form-control" type="text" value="<?=$_SESSION['txt']?>" id="id" name="id" readonly/>
                        <?php }else{?>
                        <label for="organization" class="form-label">Transaction ID</label>
                        <input class="form-control" type="text" id="id" name="id" required/>
                         <?php }?>
                        <?php if(isset($_POST['verify'])){?>
                        <label for="organization" class="form-label">Name</label>
                        <input class="form-control" type="text" id="name" value="<?=$_SESSION['customer']?>" name="name" readonly="" />
                        <label for="organization" class="form-label">Amount</label>
                        <input class="form-control" type="text" id="amount" value="<?=$_SESSION['amount']?>" name="amount" readonly="" />

                        <label for="organization" class="form-label">Event Name</label>
                        <input class="form-control" type="text" id="event" value="<?=$_SESSION['event']?>" name="event" readonly="" />
                        <label for="organization" class="form-label">Attendance</label>
                        <?php if($_SESSION['attendance'] == '1'){ 
                          $attendance = "Already Checked In";
                        }else{
                          $attendance = "Not Checked In"; 
                         } ?>
                        <input class="form-control" type="text" id="attendance" value="<?=$attendance?>" name="attendance" readonly="" />
                      </div>
                      <?php } ?>
                      <div class="mt-2">
                        <button type="submit" name="verify" class="btn btn-primary me-2">Verify</button>
                        <?php if($_SESSION['attendance'] == '1'){ ?>
                          <button type="submit" name="checkIn" class="btn btn-outline-secondary" disabled>CheckIn</button>
                        <?php }else{?>
                          <button type="submit" name="checkIn" class="btn btn-outline-secondary">CheckIn</button>
                        <?php } ?>
                       
                      </div>
                      </div>
                      <br>
                      </form>
                    </div>
                  </div>
                  <h5 class="card-header">My events</h5>
                    <div class="table-responsive text-nowrap">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Event ID</th>
                            <th>Event Name</th>
                            <th>Paid Amount</th>
                            <th>City</th>
                            <th>Event Organizer</th>
                            <th>Paid By</th>
                            <th>Email</th>
                            <th>Date Paid</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        <?php while ($row = $transaction->fetch(PDO::FETCH_ASSOC)):
                        $start = date('d-M-Y H:i', strtotime($row['tx_time']));
                        
                        ?>
                          <tr>
                            <td><?=$row['id']?></td>
                            <td><?=$row['event_name']; ?></td>
                            <td><?=$row['amount']; ?></td>
                            <td><?=$row['city']; ?></td>      
                            <td><?=$row['username']; ?></td>
                            <td><?=$row['name']; ?></td>
                            <td><?=$row['email']; ?></td>
                            <td><?= $start; ?></td>                      
                            <td>
                              <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                  <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item" href="edit-events.php?delete_id=<?=$row['id']?>"
                                    ><i class="bx bx-trash me-2"></i> Delete</a
                                  >
                                </div>
                              </div>
                            </td>
                          </tr>
                          <?php endwhile; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->
            <!-- Footer -->
            <?php require_once "includes/footer.php"; ?>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js ../assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    </script>
		<script src="plugins/jquery/jquery.min.js"></script>
		<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript" src="assets/app.js"></script>
    <script type="text/javascript" src="assets/script2.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/pages-account-settings-account.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
      let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          alert('No cameras found.');
        }
      }).catch(function(e) {
        console.error(e);
      });
      scanner.addListener('scan', function (c) {
        document.getElementById('id').value = c;
        
      });
    </script>
  </body>
</html>


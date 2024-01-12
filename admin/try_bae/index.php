<?php 
require_once "includes/sessions.php"; 
require_once "includes/event_controller.php";
require_once "includes/database.php";
require_once "includes/model.php";
require_once "includes/header.php";

$model = new model();
$events = $model->getAllEvents();

if(isset($_GET['u_id']))
{
  $id = $_GET['u_id'];
  $publish = 0;
  $model->changeState($id, $publish);
}

if(isset($_GET['p_id']))
{
  $id = $_GET['p_id'];
  $publish = 1;
  $model->changeState($id, $publish);
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
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Welcome <?php echo $_SESSION['name']; ?> 🎉</h5>
                          <p class="mb-4">
                            Here are all the <span class="fw-bold">Events</span> published on The Trybae Site. as Admin You can manage all the Events and Accounts in the system.
                          </p>

                          <a href="view-users.php" class="btn btn-sm btn-outline-primary">View Event Organizers </a>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  
              </div>
              <div class="row">
                <!-- Order Statistics -->
                <div class="container-xxl flex-grow-1 container-p-y">
                
                  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span>Events Published</h4>
                  <!-- Basic Bootstrap Table -->
                  <div class="card">
                    <h5 class="card-header">My events</h5>
                    <div class="table-responsive text-nowrap">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Event ID</th>
                            <th>Event Name</th>
                            <th>Starting</th>
                            <th>Ending</th>
                            <th>City</th>
                            <th>Created By</th>
                            <th>State</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        <?php while ($row = $events->fetch(PDO::FETCH_ASSOC)):
                        if($row['published'] == 1){
                          $state = "Published";
                        } else{
                          $state = "Unpublished";
                        }
                        $start = date('d-M-Y H:i', strtotime($row['start_time']));
                        $end = date('d-M-Y H:i', strtotime($row['end_time']));
                        ?>
                          <tr>
                            <td><?=$row['id']?></td>
                            <td><?=$row['event_name']; ?></td>
                            <td><?= $start; ?></td>
                            <td><?= $end; ?></td>
                            <td><?=$row['city']; ?></td>
                            <td><?=$row['username']; ?></td>    
                            <td><?=$state?></td>                      
                            <td>
                              <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                  <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item" href="edit-events.php?id=<?=$row['id']?>"
                                    ><i class="bx bx-edit-alt me-2"></i> Edit</a
                                  >
                                  <a class="dropdown-item" href="edit-events.php?delete_id=<?=$row['id']?>"
                                    ><i class="bx bx-trash me-2"></i> Delete</a
                                  ><?php if ($row['published']): ?>
                                    <a class="dropdown-item" href="view-events.php?u_id=<?=$row['id']?>"
                                    ><i class="bx bx-file me-2"></i>Unpublish</a
                                  ><?php else: ?>
                                    <a class="dropdown-item" href="view-events.php?p_id=<?=$row['id']?>"
                                    ><i class="bx bx-file me-2"></i>Publish</a>
                                </div>
                              </div>
                            </td>
                            <?php endif; ?>
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

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>

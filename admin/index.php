<?php require_once "includes/sessions.php"; ?>

<?php require_once "includes/header.php"; ?>

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
                          <h5 class="card-title text-primary">Welcome <?php echo $fetch_info['username'] ?> 🎉</h5>
                          <p class="mb-4">
                            Here are all the <span class="fw-bold">Stories</span> published on The Growth Stories Site. as Admin You can manage all the stories and comments published by yourself and other users.
                          </p>

                          <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Other Users</a>
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
                <?php 
										if (isset($_SESSION['message'])): ?>

											<div class="alert alert-<?=$_SEESION['msg_type']?>">

												<?php
													echo $_SESSION['message'];
													unset($_SESSION['message']);
												?>
											</div>	
									<?php endif ?>
                  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span>Stories Published</h4>
                  <?php 
										$mysqli = new mysqli('localhost', 'root', '', 'trybae_db') or die(mysqli_error($mysqli));
										$result = $mysqli->query("SELECT * FROM events") or die($mysqli->error);
									?>
                  <!-- Basic Bootstrap Table -->
                  <div class="card">
                    <h5 class="card-header">Table Basic</h5>
                    <div class="table-responsive text-nowrap">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Event Id</th>
                            <th>Event Name</th>
                            <th>Address</th>
                            <th>Total Tickets</th>
                            <th>Date</th>
                            <th>V.I.P Price</th>
                            <th>Ordinary Price</th>
                            <th></th>
                          </tr>
                        </thead>
                        <?php 
												while ($row = $result->fetch_assoc()): ?>
                        <tbody class="table-border-bottom-0">
                          <tr>
                            <td><?php echo $row['event_id']; ?></td>
                            <td><?php echo $row['event_name']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['limits']; ?></td>
                            <td><?php echo $row['dates']; ?></td>
                            <td><?php echo $row['vip']; ?></td>
                            <td><?php echo $row['ordinary']; ?></td>
                            <td>
                              <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                  <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item" href="controllerUserData.php?edit=<?php echo $row['id']; ?>"
                                    ><i class="bx bx-edit-alt me-2"></i> Edit</a
                                  >
                                  <a class="dropdown-item" href="controllerUserData.php?delete=<?php echo $row['id']; ?>"
                                    ><i class="bx bx-trash me-2"></i> Delete</a
                                  >
                                </div>
                              </div>
                            </td>
                            <?php endwhile; ?>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!--/ Basic Bootstrap Table -->
                </div>
                <!--/ Transactions -->
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

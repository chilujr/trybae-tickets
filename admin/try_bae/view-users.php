<?php 
session_start();
require_once "includes/sessions.php";
require_once "includes/header.php";
require_once "includes/model.php";
require_once 'includes/database.php'; 
//Instance of the class
$model = new model();
$eventORG = $model->getEventORG();

if(isset($_GET['u_id']))
{
    $id = $_GET['u_id'];
    $publish = "notverified";
    $account = $model->accountStatus($id, $publish);
    echo "<script>alert('Account Status Successfully Changed')</script>";    
   }

if(isset($_GET['p_id']))
{
    $id = $_GET['p_id'];
    $publish = "verified";
    $account = $model->accountStatus($id, $publish);
    echo "<script>alert('Account Status Successfully Changed')</script>";   
}

if(isset($_GET['del']))
{
    $id = $_GET['del'];
    $account = $model->deleteEventORG($id);
    echo "<script>alert('Account Status Successfully Changed')</script>";   
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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Action /</span> Manage Event Organizers</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link" href="add-user.php"><i class="bx bx-plus me-1"></i>Add Event Organizer</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="view-users.php"
                        ><i class="bx bx-bell me-1"></i>View Event Organizer</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="view-admin.php"
                        ><i class="bx bx-bell me-1"></i>View Administrators</a
                      >
                    </li>
                  </ul>
                  <!-- Basic Bootstrap Table -->
                  <div class="card">
                    <h5 class="card-header">Table Basic</h5>
                    <div class="table-responsive text-nowrap">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>User Id</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Date & Time Added</th>
                          </tr>
                        </thead>
                        <?php while ($row = $eventORG->fetch(PDO::FETCH_ASSOC)): ?>
                        <tbody class="table-border-bottom-0">
                          <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['role']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
    
                            
                            <td>
                              <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                  <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item" href="controllerUserData.php?edit=<?php echo $row['id']; ?>"
                                    ><i class="bx bx-edit-alt me-2"></i> Edit</a
                                  >
                                  <?php if ($row['activation_status'] == "verified"): ?>
                                    <a class="dropdown-item" href="view-users.php?u_id=<?php echo $row['id']; ?>"
                                    ><i class="bx bx-file me-2"></i>De-Activate</a
                                  ><?php else: ?>
                                    <a class="dropdown-item" href="view-users.php?p_id=<?php echo $row['id']; ?>"
                                    ><i class="bx bx-file me-2"></i>Activate</a>
                                    <?php endif; ?>
                                  <a class="dropdown-item" href="view-users.php?del=<?php echo $row['id']; ?>"
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
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/pages-account-settings-account.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

  </body>
</html>

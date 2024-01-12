<?php 
require_once "includes/sessions.php"; 
require_once "includes/event_controller.php";
require_once "includes/database.php";
require_once "includes/model.php";
require_once "includes/header.php";
$user = $_SESSION['id'];
$model = new model();
$myprofile = $model->getUser($user);
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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    
                    <?php while($profile = $myprofile->fetch(PDO::FETCH_ASSOC)):{
                      if(empty($profile['images'])):
                        $src = "../assets/img/avatars/1.png";
                      else:
                        $src = "../../admin/uploads/profile/admin/".$profile['images'];
                      endif;
                    }
                      
                      ?>
                      
                    
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="<?=$src?>" alt="user-avatar" class="d-block rounded" height="100"  width="100" id="uploadedAvatar"/>
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input  type="file" name="upload" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg"/>
                          </label>
                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <?php
                    /*
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }*/
                    ?>
                    <div class="card-body">
                      <form id="formAccountSettings"  method="POST" onsubmit="false" enctype="multipart/form-data">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Username</label>
                            <input
                              class="form-control" type="text" id="Username" name="username" value="<?=$profile['username'];?>" autofocus/>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Role</label>
                            <?php if($profile['role'] == 'Admin'):
                              $admin = "<input class='form-control' type='text' name='role' id='role' value='Admin' disabled/>"; 
                              else:
                              $admin = "<input class='form-control' type='text' name='role' id='role' value='User' disabled/>";
                            endif;?>
                            <?=$admin;?>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control" type="text" id="email" name="email" value="<?=$profile['email'];?>" placeholder="john.doe@example.com"/>
                          </div>

                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Profile Image</label>
                            <input class="form-control" type="file" id="image" name="image" required/>
                          </div>

                          <div class="mb-3 col-md-12">
                              <label for="organization" class="form-label">Password</label>
                             <input class="form-control" type="password" id="password" name="password" placeholder="Enter Password" required/>
                          </div>
                        </div>
                        <?php endwhile;?>
                        <div class="mt-2">
                          <input type="submit" name="update-profile" class="btn btn-primary me-2" value="Save changes"/>
                          <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
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

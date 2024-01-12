<?php 
session_start();
require_once "includes/sessions.php";
require_once "includes/header.php";
require_once "includes/model.php";
require_once 'includes/database.php';

//Instance of the class
$model = new model();
$ageGroup = $model->getAgeGroups();
$cities = $model->getCities();
$categories= $model->getCategories();
if(isset($_GET['id']))
{
  $id = $_GET['id'];
  $event_details = $model->getEvent($id);
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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Action /</span> Edit Event</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-plus me-1"></i> Edit Event</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="view-posts.php"
                        ><i class="bx bx-bell me-1"></i>View Story</a
                      >
                    </li>
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">Event's Content</h5>

                    <?php while($event = $event_details->fetch(PDO::FETCH_ASSOC)):{
                      if(empty($event['images'])):
                        $src = "../assets/img/avatars/1.png";
                      else:
                        $src = "../../admin/uploads/".$event['images'];
                      endif;
                    }
                      ?>
                      
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="<?=$src?>" alt="user-avatar" class="d-block rounded" height="200"  width="200" id="uploadedAvatar"/>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      
                    <form  method="POST" enctype="multipart/form-data">
                      <div class="row">
                      <input type="hidden" name="event_id" value="<?=$id;?>">
                        <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Event Name</label>
                            <input
                              class="form-control" type="text" id="event_name" name="event_name" value="<?=$event['event_name']?>" placeholder="<?=$event['event_name']?>" autofocus
                            />
                        </div>

                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?=$event['address']?>" placeholder="<?=$event['address']?>" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Ticket Numbers</label>
                            <input class="form-control" type="text" id="limits" name="limits" value="<?=$event['attendance_limit']?>" placeholder="<?=$event['attendance_limit']?>" />
                          </div>
                         
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Age Restrictions</label>
                            <select class="select2 form-select" name="age_id" id="age" required>
                                <option value="<?=$event['age_id']?>"><?=$event['age']?></option>
                              <?php while ($age = $ageGroup->fetch(PDO::FETCH_ASSOC)): ?>
                                <?php if (!empty($age_id) && $age_id == $age['id']): ?>
                                  <option selected value="<?=$age['id']?>">  <?=$age['age']?> </option>
                                <?php else: ?>
                                  <option value="<?=$age['id']?>">  <?=$age['age']?> </option>
                                <?php endif; ?>
                                <?php endwhile; ?>
                            </select>
                          </div>
                         <?php
                            $start = date('M/d/Y H:i:s', strtotime($event['start_time']));
                            $end = date('M/d/Y H:i:s', strtotime($event['end_time']));
                            ?>
                          <div class="mb-3 col-md-6">
                            <label for="date" class="form-label">Starting</label>
                            <input class="form-control" type="text" name="start_time" value="<?=$event['start_time']?>" placeholder="<?=$event['start_time']?>" required>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="timeZones" class="form-label">Ending</label>
                            <input class="form-control" type="text" name="end_time" value="<?=$event['end_time']?>" placeholder="<?=$event['end_time']?>"  required>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Province</label>
                            <option value="">Select City</option>
                            <select class="select2 form-select" name="city_id" id="city" required>
                            <?php while ($city = $cities->fetch(PDO::FETCH_ASSOC)): ?>
                                <?php if (!empty($city_id) && $city_id == $city['id']): ?>
                                  <option selected value="<?=$city['id']?>">  <?=$city['city']?> </option>
                                <?php else: ?>
                                  <option value="<?=$city['id']?>">  <?=$city['city']?> </option>
                                <?php endif; ?>
                                <?php endwhile; ?>
                            </select>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Category</label>
                            <option value="">Select Category</option>
                            <select class="select2 form-select" name="category_id" id="category" required>
                            <?php while ($category = $categories->fetch(PDO::FETCH_ASSOC)): ?>
                                <?php if (!empty($category_id) && $category_id == $category['id']): ?>
                                  <option selected value="<?=$category['id']?>">  <?=$category['category']?> </option>
                                <?php else: ?>
                                  <option value="<?=$category['id']?>">  <?=$category['category']?> </option>
                                <?php endif; ?>
                                <?php endwhile; ?>
                            </select>
                          </div>
                          <div class="col-md-8">
                            <h5 class="card-header">Ticket Prices</h5>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">Ordinary</label>
                            <input class="form-control" type="text" id="price" name="ordinary" value="<?=$event['ordinary']?>" placeholder="<?=$event['ordinary']?>" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">V.I.P</label>
                            <input class="form-control" type="text" id="price" name="vip" value="<?=$event['vip']?>" placeholder="<?=$event['vip']?>" />
                          </div>
                        </div>
                        <div class="row">
                        <div class="mb-3 col-md-6">
                              <label for="organization" class="form-label">Event Image</label>
                              <input class="form-control" type="file" id="image" name="event_image" placeholder="Select Image" />
                          </div>
                          <div class="mb-3 col-md-6">
                              <label for="organization" class="form-label">Additional Information</label>
                              <textarea
                                type="text"
                                class="form-control"
                                id="Additional"
                                name="add_info"
                                placeholder="<?=$event['add_info']?>"
                              ><?=$event['add_info']?></textarea>
                          </div>

                          <div class="mb-3 col-md-6">
                            <?php $published = $event['published'];
                            if ($published == "0"): ?>
                              <label for="publishing">
                                <input type="checkbox" name="published">
                                Publish this post?
                              </label>
                            <?php else: ?>
                              <label for="publishing">
                                <input type="checkbox" name="published" checked>
                                Publish this post?
                              </label>
                            <?php endif; ?>
                          </div>
                          
                          <div class="mt-2">
                            <button type="submit" name="update-event" class="btn btn-primary me-2">Save changes</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                          </div>
                        </div>
                      </form>
                      <?php endwhile; ?>
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
    <!-- build:js ../assets/vendor/js/core.js -->
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

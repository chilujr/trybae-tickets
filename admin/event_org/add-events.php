<?php 
session_start();
require_once "includes/header.php";
require_once "includes/model.php";
require_once 'includes/database.php'; 
//Instance of the class
$model = new model();
$ageGroup = $model->getAgeGroups();
$cities = $model->getCities();
$categories= $model->getCategories();
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

          <?php require_once "includes/nav-no-search.php"; ?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Action /</span> Add Event</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="add-events.php"><i class="bx bx-plus me-1"></i> Add Events</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="view-events.php"
                        ><i class="bx bx-bell me-1"></i>View Events</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="ticket_purchase.php"
                        ><i class="bx bx-bell me-1"></i>View Transactions</a
                      >
                    </li>
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <hr class="my-0" />
                    <div class="card-body">
                    <form  method="POST"  enctype="multipart/form-data">
                        <?php 
                          if (isset($_SESSION['status'])) {
                              echo "<h4>".$_SESSION['status']."</h4>";
                              unset($_SESSION['status']);
                          }
                        ?>
                        <div class="row">

                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Event Name</label>
                            <input
                              class="form-control" type="text" id="event_name" name="event_name" placeholder="Oasis Fest" autofocus
                            />
                          </div>

                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Ticket Numbers</label>
                            <input class="form-control" type="text" id="limits" name="limits" placeholder="Enter Number of Available Tickets" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Age Restrictions</label>
                            <select class="select2 form-select" name="age_id" id="age" required>
                              <option value="">Select age</option>
                              <?php while ($age = $ageGroup->fetch(PDO::FETCH_ASSOC)): ?>
                                <?php if (!empty($age_id) && $age_id == $age['id']): ?>
                                  <option selected value="<?=$age['id']?>">  <?=$age['age']?> </option>
                                <?php else: ?>
                                  <option value="<?=$age['id']?>">  <?=$age['age']?> </option>
                                <?php endif; ?>
                                <?php endwhile; ?>
                            </select>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="date" class="form-label">Starting</label>
                            <input class="form-control" type="datetime-local" name="start_time" required>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="timeZones" class="form-label">Ending</label>
                            <input class="form-control" type="datetime-local" name="end_time"  required>
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
                            <input class="form-control" type="text" id="price" name="ordinary" placeholder="Enter Ordinary price" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">V.I.P</label>
                            <input class="form-control" type="text" id="price" name="vip" placeholder="Enter VIP price" />
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
                                placeholder="Additional Information"
                              ></textarea>
                          </div>

                          <div class="mb-3 col-md-6">
                            <?php if (empty($published)): ?>
                              <label for="publishing">
                                <input type="checkbox" value="0" name="published">
                                Publish this post?
                              </label>
                            <?php else: ?>
                              <label for="publishing">
                                <input type="checkbox" value="1" name="published" checked>
                                Publish this post?
                              </label>
                            <?php endif; ?>
                          </div>
                          <div class="mt-2">
                            <button type="submit" name="add-event" class="btn btn-primary me-2">Save changes</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                          </div>
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
